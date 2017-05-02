<?php namespace Starlight\PackageStatuses;

use Packages;

class PackageStatusesServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageStatusesController'];

	/**
	 * @var array
	 */
	protected $models = ['Status', 'Statusable'];

	/**
	 * @return void
	 */
	public function init()
	{
		// $this->migrations(__DIR__ . '/../../../migrations');

		$this->addSidebarControl('package-statuses', '\Packages\PackageStatusesController@getList', [
			// 'parent' => $this->requireSidebarGroup('packages', 'Packags', 'pencil'),
			'title' => _('Statuses'),
			'icon' => 'crosshairs',
		]);

		// injections

		$this->registerInjectTpl(['StatusesFormBase'], 'package-statuses::inject.select', function ($entity)
		{
			if (old('status_id')) {
				return [
					'statuses'   => Packages\Status::lists('title', 'id'),
					'selected'   => old('status_id')
				];
			} else {
				return [
					'statuses'   => Packages\Status::lists('title', 'id'),
					'selected'   => $entity ? $entity->morphToMany('\Packages\Status', 'statusable')->lists('id') : null
				];
			}
		});

		$this->registerInjectHandler(['StatusesAdd', 'StatusesEdit'], function ($entity, $request)
		{
			$entity->morphToMany('\Packages\Status', 'statusable')->sync($request->get('status_id') ?: []);
		});

		$this->registerInjectRules(['StatusesAdd', 'StatusesEdit'],
		[
			'status_id' => 'array|each:exists,statuses,id'
		]);

	}

}
