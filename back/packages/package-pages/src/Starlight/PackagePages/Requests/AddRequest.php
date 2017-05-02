<?php namespace Starlight\PackagePages\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|max:255',
			'slug'  => 'required|alpha_dash|max:255',
			'body' => '',
			'is_active' => 'required|in:1,0',
		];
	}

}
