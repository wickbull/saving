<?php namespace Starlight\PackageNewsCategories;

use Packages;

class PackageNewsCategoriesServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageNewsCategoriesController'];

	/**
	 * @var array
	 */
	protected $models = ['NewsCategory', 'NewsNewsCategory'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-news-categories', '\Packages\PackageNewsCategoriesController@getList', [
			'parent' => $this->requireSidebarGroup('news', _('News'), 'newspaper-o'),
			'title' => _('News categories'),
			'icon' => 'bars',
		]);


		$this->registerInjectTpl(['NewsCategoryFormBase'], 'package-news-categories::inject.select', function ($entity)
		{
			$categories = Packages\NewsCategory::withTranslation('uk')->get();
			$categories = $categories->toArray();

			$all_categories = array();

			if (! empty($categories)) {

				foreach($categories as $category) {

					if(isset($category['title'])) {
						$all_categories[$category['id']] = $category['title'];
					}
				}
			}

			return [
				'categories' => $all_categories,
				'selected'   => $entity ? $entity->belongsToMany('\Packages\NewsCategory')->lists('id') : null
			];
		});

		$this->registerInjectHandler(['NewsCategoryAdd', 'NewsCategoryEdit'], function ($entity, $request)
		{
			$entity->belongsToMany('\Packages\NewsCategory')->sync($request->get('news_category_id') ?: []);
		});

		$this->registerInjectRules(['NewsCategoryAdd', 'NewsCategoryEdit'],
		[
			'news_category_id' => 'array|each:exists,news_categories,id'
		]);

	}

}
