<?php namespace Starlight\PackageUsers\Requests;

class PasswordResetRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 *
	 */
	public function rules()
	{
		return [
			'password' => 'confirmed|min:6'
		];

	}

}
