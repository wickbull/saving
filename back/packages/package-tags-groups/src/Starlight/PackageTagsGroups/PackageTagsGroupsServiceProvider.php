<?php namespace Starlight\PackageTagsGroups;

class PackageTagsGroupsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageTagsGroupsController'];

	/**
	 * @var array
	 */
	protected $models = ['TagsGroup'];

	/**
	 * @return void
	 */
	public function init()
	{
		// $this->migrations(__DIR__ . '/../../../migrations');

		$this->addSidebarControl('package-tags-groups', '\Packages\PackageTagsGroupsController@getList', [
			// 'parent' => $this->requireSidebarGroup('tags', _('Tags'), 'tags'),
			'title' => _('Tags groups'),
			'icon' => 'bars',
		]);

	}

}
