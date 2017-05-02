<?php namespace Starlight\PackageTags\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{

		return [
			'name'  => "required|max:255",
		];
	}

}
