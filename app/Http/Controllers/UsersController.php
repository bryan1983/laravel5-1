<?php
/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 12/10/2015
 * Time: 8:12
 */

namespace Curso\Http\Controllers;


use Curso\User;

class UsersController extends Controller
{
    public function getOrm()
    {
        //$users = User::get();
        $users = User::select('id','first_name')
            ->with('profile')
            ->where('type', '<>','admin')
            ->orderBy('first_name', 'ASC')
            ->get();

        dd($users->toArray());
        //dd($users);
    }


    public function getIndex()
    {
        // QueryBuilder --> Fluent
        $result = \DB::table('users')
            //->select(['users.first_name', 'users.last_name'])
            ->select(
                'users.*',
                //'users.first_name',
                //'users.last_name',
                'user_profiles.id as profile_id',
                'user_profiles.twitter',
                'user_profiles.birthdate'
            )
            ->where('type', '<>', 'admin')
            // DB::raw no nos protege sobre inyecciones SQL
            ->orderBy(\DB::raw('RAND()'))
            //->orderBy('first_name', 'ASC')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            // leftJoin
            ->get();


        // Para obtener datos personalizados, tenemos que cargar el controlador con programación
        foreach($result AS $row)
        {
            $row->full_name = $row->first_name .' '. $row->last_name;
            $row->age = \Carbon\Carbon::parse($row->birthdate)->age;
        }

        dd($result);
        return $result;
    }

}