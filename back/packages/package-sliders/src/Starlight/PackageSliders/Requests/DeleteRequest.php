<?php namespace Starlight\PackageSliders\Requests;

class DeleteRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['SliderDelete'];

	/**
	 * @return array
	 */
	public function rules()
	{
		return [];
	}

}
