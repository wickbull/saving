<?php namespace Starlight\PackageTagsGroups\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{

		return [
			'title' => 'required|max:255',
			'slug'  => 'required|alpha_dash|max:255|unique:tags_groups,slug',
			'is_top' => 'required|in:1,0',
			'locale' => 'required|max:2',
			'tags_name' => 'array'
		];
	}

}
