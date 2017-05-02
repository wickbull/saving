<?php namespace Starlight\PackageUsers\Requests;


class AddRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['UsersAdd'];

	/**
	 *
	 */
	public function rules()
	{
		return [
			'email' => 'email|max:255|unique:users',
			'password' => 'confirmed|min:6',
			'first_name' => 'required|max:128',
			'last_name' => 'required|max:128',
			'descr' => '',
			'photo_storage_id' => 'integer|exists:generic_files,id',
		];

	}

}
