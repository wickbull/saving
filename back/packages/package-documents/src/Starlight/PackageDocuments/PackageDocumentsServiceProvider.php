<?php namespace Starlight\PackageDocuments;

use Packages;

class PackageDocumentsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageDocumentsController'];

	/**
	 * @var array
	 */
	protected $models = ['Document'];

	/**
	 * @return void
	 */
	public function init()
	{

		$this->addSidebarControl('package-documents', '\Packages\PackageDocumentsController@getList', [
			'title' => _('Documents'),
			'icon' => 'file-pdf-o',
		]);

	}

}
