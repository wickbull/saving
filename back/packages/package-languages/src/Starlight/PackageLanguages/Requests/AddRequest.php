<?php namespace Starlight\PackageLanguages\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	public $inject_rules = ['join-to-page'];

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|max:128',
			'code'  => 'required|max:2',
			'locale' => 'required|max:5',
			'is_active' => 'required|in:1,0',
		];
	}

}
