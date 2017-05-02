<?php namespace Starlight\PackageLanguages;
use Input;

class PackageLanguagesServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageLanguagesController'];

	/**
	 * @var array
	 */
	protected $models = ['Language'];

	/**
	 *
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-languages', '\Packages\PackageLanguagesController@getList', [
			'title' => _('Languages'),
			'icon' => 'language',
		]);

		$this->registerInjectTpl(['LanguagesFormBase'], 'package-languages::inject.list', function ($entity)
		{
			return ['languages' => \Packages\Language::where('is_active', '=', 1)->orderBy('code', 'DESC')->get(), 
				'this_lang' => Input::get('lang') === null ? 'uk' : Input::get('lang')];

		});
	}

}
