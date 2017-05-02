<?php namespace Starlight\PackageUsers\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['UsersEdit'];

	/**
	 *
	 */
	public function rules()
	{
		$id = $this->route()->parameter('user')->id;

		return [
			'email' => "email|max:255|unique:users,email,{$id}",
			'first_name' => 'required|max:128',
			'last_name' => 'required|max:128',
			'descr' => '',
			'photo_storage_id' => 'integer|exists:generic_files,id',
		];

	}

}
