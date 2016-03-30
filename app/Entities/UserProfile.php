<?php namespace Curso\Entities;

class UserProfile extends Entity {

	//
    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->birthdate)->age;
    }
}
