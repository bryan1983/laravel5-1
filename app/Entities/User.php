<?php
namespace Curso\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Entity implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, Authorizable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'password', 'type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public static function filterAndPaginate($name, $type)
	{
		return User::name($name)
						->type($type)
						->orderBy('id', 'DESC')
						->paginate();
	}

	public function profile()
	{
		return $this->hasOne('Curso\UserProfile');
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::getClass());
	}

	public function voted()
	{
		return $this->belongsToMany(Ticket::getClass(), 'ticket_votes')->withTimestamps();
	}

	public function hasVoted(Ticket $ticket)
	{
		// return TicketVote::where(['user_id' => $this->id, 'ticket_id' => $ticket->id])->count();
		return $this->voted()->where('ticket_id', $ticket->id)->count();
	}

	public function getFullNameAttribute()
	{
		return $this->first_name .' '.$this->last_name;
	}

	/*public function setPasswordAttribute($value)
	{
		if(!empty($value))
			$this->attributes['password'] = bcrypt($value);
	}*/

	public function scopeName($query, $name)
	{
		if(trim($name) != "")
			$query->where( \DB::raw("CONCAT(first_name, ' ', last_name)"), "LIKE", "%$name%");
	}

	public function scopeType($query, $type)
	{
		$types = config('options.types');

		if($type != "" && isset($types[$type]))
		{
			$query->where('type', $type);
		}
	}

	public function isAdmin()
	{
		return $this->role === 'admin';
	}

}
