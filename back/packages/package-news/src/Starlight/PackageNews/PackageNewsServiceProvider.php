<?php namespace Starlight\PackageNews;

use App\Traits\Translatable;
use Packages;

class PackageNewsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageNewsController'];

	/**
	 * @var array
	 */
	protected $models = ['News', 'NewsTranslation'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-news', '\Packages\PackageNewsController@getList', [
			'parent' => $this->requireSidebarGroup('news', _('News'), 'newspaper-o'),
			'title' => _('News'),
			'icon' => 'newspaper-o',
		]);

		$this->registerInjectTpl(['UsersMaterialsTab'], 'package-news::inject.tab', function ($entity)
		{
			return ['user' => $entity];
		});

		$this->registerInjectTpl(['UsersMaterialsTabContent'], 'package-news::inject.tab-content', function ($entity)
		{
			return ['user' => $entity];
		});

	}

}
