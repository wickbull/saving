<?php namespace Starlight\PackageNewsCategories\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'     => 'required|max:255',
			'slug'      => "required|alpha_dash|max:255",
			'is_active' => 'required|in:1,0',
			'is_top'    => 'required|in:1,0',
		];
	}

}
