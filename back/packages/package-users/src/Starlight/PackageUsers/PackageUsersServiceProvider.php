<?php namespace Starlight\PackageUsers;

class PackageUsersServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageUsersController'];

	/**
	 * @var array
	 */
	protected $models = ['User', 'UserUsersTeam'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-users', '\Packages\PackageUsersController@getList', [
			'parent' => $this->requireSidebarGroup('users', _('Users'), 'user'),
			'title' => _('List'),
			'icon' => 'file-text',
		]);
	}

}
