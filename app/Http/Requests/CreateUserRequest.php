<?php namespace Curso\Http\Requests;

use Curso\Http\Requests\Request;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'email'			=> 'required|unique:users,email',
			'password'		=> 'required|min:6|confirmed',
			'type'			=> 'required|in: user,admin,editor,contributor'
		];
	}

}
