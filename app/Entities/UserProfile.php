<?php namespace Curso\Entities;

class UserProfile extends Entity {

    protected $fillable = ['user_id', 'bio', 'twitter', 'birthdate', 'website'];
	//
    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->birthdate)->age;
    }
}
