<?php namespace Starlight\PackageFragments;

class PackageFragmentsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageFragmentsController'];

	/**
	 * @var array
	 */
	protected $models = ['Fragment'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-fragments', '\Packages\PackageFragmentsController@getList', [
			// 'parent' => $this->requireSidebarGroup('content', _('Content'), 'pencil'),
			'title' => _('Fragments'),
			'icon' => 'edit',
		]);

	}


}
