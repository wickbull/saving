<?php namespace Starlight\PackageSettings\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|max:128',
			'type'  => 'required|alpha_dash|max:32',
			'value' => 'required|max:2048',
			'locale' => 'required|max:2'
		];
	}

}
