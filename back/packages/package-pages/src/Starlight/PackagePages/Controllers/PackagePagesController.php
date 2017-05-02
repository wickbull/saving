<?php namespace Starlight\PackagePages\Controllers;

use Starlight\PackagePages\Requests;
use Input;
use Packages;
use Illuminate\Support\Facades\App;

class PackagePagesController extends \Starlight\Kernel\Packages\AbstractController{

	/**
	 * @return Response
	 */
	public function getList()
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		$pages = Packages\Page::translatedIn($lang)->paginate(15);

		return view('package-pages::list', [
			'pages' => $pages
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		return view('package-pages::add', [
			'lang' => $lang
			]);
	}

	/**
	 * @param  Requests\AddRequest $request
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		App::make('config')->set('translatable.locale', $request->input('lang'));

		$page = new \Packages\Page($request->allWithRules());

		$page->save();

		return redirect(action('\Packages\PackagePagesController@getList'))
			->withMessagesSuccess([_('Page created successfully')]);
		;
	}

	/**
	 * @param  Packages\Page $page
	 * @return Response
	 */
	public function getEdit(Packages\Page $page)
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		return view('package-pages::edit', [
			'page' => $page,
			'lang' => $lang
		]);
	}

	/**
	 * @param  Packages\Page       $page
	 * @param  Requests\EditRequest  $request
	 * @return Response
	 */
	public function postEdit(Packages\Page $page, Requests\EditRequest $request)
	{
		App::make('config')->set('translatable.locale', $request->input('lang'));

		$page->fill($request->allWithRules());

		$page->save();

		return redirect(action('\Packages\PackagePagesController@getList'))
			->withMessagesSuccess([_('Page saved successfully')]);
	}


	/**
	 * @param
	 * @return Response
	 */
	public function deleteDelete(Packages\Page $page)
	{
		$page->delete();

		return redirect(action('\Packages\PackagePagesController@getList'))
			->withMessagesSuccess([_('Page deleted successfully')]);
	}


	/**
	 * @return array
	 */
	public function getCheckSlug()
	{
		return [
			'slug' => Input::get('slug'),
			'exists' => 0
		];
	}

}
