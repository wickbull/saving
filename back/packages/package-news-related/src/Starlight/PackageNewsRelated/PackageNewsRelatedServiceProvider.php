<?php namespace Starlight\PackageNewsRelated;

use Packages;

class PackageNewsRelatedServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageNewsRelatedController'];

	/**
	 * @var array
	 */
	protected $models = [];

	/**
	 * @return void
	 */
	public function init()
	{

		// injections

		$this->registerInjectTpl(['NewsFormBase'], 'package-news-related::inject.form-list', function ($entity)
		{
			if (old('news_related_id'))
			{
				return ['related_news' => \Packages\News::whereIn('id', old('news_related_id'))->get()];
			}

			return ['related_news' => $entity ? $entity->morphToMany('\Packages\News', 'newsable')->get() : []];
		});


		$this->registerInjectTpl(['NewsFormSidebarTabs'], 'package-news-related::inject.form-sidebar-tab', function ($entity)
		{
			return [];
		});

		$this->registerInjectTpl(['NewsFormSidebarContent'], 'package-news-related::inject.form-sidebar-content', function ($entity)
		{
			return [];
		});

		$this->registerInjectHandler(['NewsAdd', 'NewsEdit'], function ($entity, $request)
		{
			$entity->morphToMany('\Packages\News', 'newsable')->sync($request->get('news_related_id') ?: []);
		});

		$this->registerInjectRules(['NewsAdd', 'NewsEdit'],
		[
			'news_related_id' => 'array|each:exists,news,id'
		]);

	}

}
