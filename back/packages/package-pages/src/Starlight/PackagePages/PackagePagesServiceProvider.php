<?php namespace Starlight\PackagePages;

class PackagePagesServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackagePagesController'];

	/**
	 * @var array
	 */
	protected $models = ['Page'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-pages', '\Packages\PackagePagesController@getList', [
			// 'parent' => $this->requireSidebarGroup('content', _('Content'), 'pencil'),
			'title' => _('Pages'),
			'icon' => 'file-o',
		]);

	}


}
