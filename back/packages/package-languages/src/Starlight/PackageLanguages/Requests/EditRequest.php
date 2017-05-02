<?php namespace Starlight\PackageLanguages\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

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
