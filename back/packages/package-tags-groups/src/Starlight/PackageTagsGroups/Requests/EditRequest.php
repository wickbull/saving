<?php namespace Starlight\PackageTagsGroups\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route()->parameter('tags_group')->id;

		return [
			'title' => 'required|max:255',
			'slug'  => "required|alpha_dash|max:255|unique:tags_groups,slug,{$id}",
			'is_top' => 'required|in:1,0',
			'locale' => 'required|max:2',
			'tags_name' => 'array'
		];
	}

}
