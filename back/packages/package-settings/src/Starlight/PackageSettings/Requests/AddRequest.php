<?php namespace Starlight\PackageSettings\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	public $inject_rules = ['join-to-page'];

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'  => 'required|alpha_dash|max:64',
			'title' => 'required|max:128',
			'type'  => 'required|alpha_dash|max:32',
			'value' => 'required|max:2048',
			'locale' => 'required|max:2'
		];
	}

}
