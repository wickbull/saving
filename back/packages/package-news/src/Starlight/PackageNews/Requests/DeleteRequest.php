<?php namespace Starlight\PackageNews\Requests;

class DeleteRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['NewsDelete'];

	/**
	 * @return array
	 */
	public function rules()
	{
		return [];
	}

}
