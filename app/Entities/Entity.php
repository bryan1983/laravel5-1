<?php
/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 26/03/2016
 * Time: 9:30
 */

namespace Curso\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public static function getClass()
    {
        return get_class(new static);
    }
}