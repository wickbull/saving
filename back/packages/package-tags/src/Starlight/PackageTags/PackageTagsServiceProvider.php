<?php namespace Starlight\PackageTags;

use Packages;

class PackageTagsServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageTagsController'];

	/**
	 * @var array
	 */
	protected $models = ['Tag', 'Taggable'];

	/**
	 * @return void
	 */
	public function init()
	{
		// $this->migrations(__DIR__ . '/../../../migrations');

		$this->addSidebarControl('package-tags', '\Packages\PackageTagsController@getList', [
			// 'parent' => $this->requireSidebarGroup('tags', _('Tags'), 'tags'),
			'title' => _('Tags'),
			'icon' => 'tags',
		]);

		// injections

		$this->registerInjectTpl(['TagsFormBase'], 'package-tags::inject.select', function ($entity)
		{
			if (old('tag_name')) {
				return [
					'tags'   => array_flip (old('tag_name'))
				];
			} else {
				return [
					'tags'   => $entity && $entity->getTranslation() ? $entity->getTranslation()->morphToMany('\Packages\Tag', 'taggable')->lists('name', 'name') : []
				];
			}

		});

		$this->registerInjectHandler(['TagsAdd', 'TagsEdit'], function ($entity, $request)
		{
			$ids = [];
			if ($request->has('tag_name'))
			{
				$tags = $request->get('tag_name');
				foreach ($tags as $tag_name) {
					$tag_name = trim(mb_strtolower($tag_name));
					if(Packages\Tag::where('name', $tag_name)->count() <= 0)
					{
						Packages\Tag::create(['name' => $tag_name]);

					}
				}
				$ids = Packages\Tag::whereIn('name', $tags ?: [])->lists('id');
			}

			$entity->getTranslation()->morphToMany('\Packages\Tag', 'taggable')->sync($ids ?: []);
		});

		$this->registerInjectRules(['TagsAdd', 'TagsEdit'],
		[
			'tag_name' => 'array'
		]);

	}

}
