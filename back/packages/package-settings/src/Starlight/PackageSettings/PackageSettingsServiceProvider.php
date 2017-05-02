<?php namespace Starlight\PackageSettings;

class PackageSettingsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageSettingsController'];

	/**
	 * @var array
	 */
	protected $models = ['Setting'];

	/**
	 *
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-settings', '\Packages\PackageSettingsController@getList', [
			'title' => _('Settings'),
			'icon' => 'cog',
		]);
	}

}
