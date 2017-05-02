<?php namespace Starlight\PackageFragments\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route()->parameter('fragment')->id;

		return [
			'title' => 'required|max:255',
			'slug'  => "required|alpha_dash|max:255",
			'body' => '',
			'is_active' => 'required|in:1,0',
		];
	}

}
