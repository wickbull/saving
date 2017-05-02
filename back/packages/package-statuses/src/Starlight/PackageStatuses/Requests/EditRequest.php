<?php namespace Starlight\PackageStatuses\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route()->parameter('status')->id;

		return [
			'title' => 'required|max:255',
			'slug'  => "required|alpha_dash|max:255|unique:statuses,slug,{$id}",
		];
	}

}
