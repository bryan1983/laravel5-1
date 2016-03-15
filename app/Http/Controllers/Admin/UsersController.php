<?php namespace Curso\Http\Controllers\Admin;

use Curso\Http\Requests\CreateUserRequest;
use Curso\Http\Controllers\Controller;

use Curso\Http\Requests\EditUserRequest;
use Curso\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller {

	public function __construct()
	{
		$this->beforeFilter('@findUser', ['only' => ['show', 'destroy', 'update', 'edit']]);
	}

	public function findUser(Route $route)
	{
		$this->user = User::findOrFail($route->getParameter('users'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		//$users = User::paginate();
		//$users = User::name($request->get('name'))->type($request->get('type'))->orderBy('id', 'DESC')->paginate();
		$users = User::filterAndPaginate($request->get('name'), $request->get('type'));

		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param Redirect $redirect
	 * @return Response
	 */
	public function store(CreateUserRequest $request/*Request $request*/, Redirector $redirect)
	{
		$data = $request->all();
		// VALIDACIONES: 1º Parte (Mediante el Facades Validator)
		/*
		$rules = array(
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'email'			=> 'required',
			'password'		=> 'required',
			'type'			=> 'required'
		);

		$v = Validator::make($data, $rules);

		if($v->fails())
		{
			return $redirect->back()
							->withErrors($v->errors())
							->withInput($request->except('password'));
		}
		*/
		// FIN VALIDACINOES: 1º Parte

		// VALIDACIONES: 2º Parte (Mediante el Trait Validate dentro del controlador --> use ValidatesRequests)
		/*
		$rules = array(
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'email'			=> 'required',
			'password'		=> 'required',
			'type'			=> 'required'
		);

		$this->validate($request, $rules);
		*/
		// FIN VALIDACIONES: 2º Parte

		// VALIDACIONES: 3º Parte (Utilizando Form Request, esto nos permite extraer la validacion fuera de la clase del controlador)

		$user = new User($data);

		$user->save();

		return $redirect->route('admin.users.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//$user = User::findOrFail($id);
		//return view('admin.users.edit', compact('user'));
		return view('admin.users.edit')->with('user', $this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditUserRequest $request)
	{
		//$user = User::findOrFail($id);
		//$user->fill($request->all());
		//$user->save();


		$this->user->fill($request->all());
		$this->user->save();


		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		//$user = User::findOrFail($id);
		//User::destroy($id);
		//$user->delete();

		$this->user->delete();

		$message = 'El usuario: '.$this->user->full_name.'  fue eliminado.';

		if($request->ajax()){
			return response()->json([
				'id'		=> $this->user->id,
				'message' 	=> $message
			]);
			//return $message;
		}

		Session::flash('message', $message);

		return redirect()->route('admin.users.index');
	}

}
