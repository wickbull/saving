<?php namespace Starlight\PackageTags\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'  => 'required|max:255|unique:tags,name',
		];
	}

}
