<?php namespace Starlight\PackageFragments\Controllers;

use Starlight\PackageFragments\Requests;
use Input;
use Packages;
use Illuminate\Support\Facades\App;

class PackageFragmentsController extends \Starlight\Kernel\Packages\AbstractController{

	/**
	 * @return Response
	 */
	public function getList()
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		$fragments = Packages\Fragment::translatedIn($lang)->paginate(15);

		return view('package-fragments::list', [
			'fragments' => $fragments
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		return view('package-fragments::add', [
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

		$fragment = new \Packages\Fragment($request->allWithRules());

		$fragment->save();

		return redirect(action('\Packages\PackageFragmentsController@getList'))
			->withMessagesSuccess([_('Fragment created successfully')]);
		;
	}

	/**
	 * @param  Packages\Fragment $fragment
	 * @return Response
	 */
	public function getEdit(Packages\Fragment $fragment)
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		return view('package-fragments::edit', [
			'fragment' => $fragment,
			'lang' => $lang
		]);
	}

	/**
	 * @param  Packages\Fragment       $fragment
	 * @param  Requests\EditRequest  $request
	 * @return Response
	 */
	public function postEdit(Packages\Fragment $fragment, Requests\EditRequest $request)
	{
		App::make('config')->set('translatable.locale', $request->input('lang'));

		$fragment->fill($request->allWithRules());

		$fragment->save();

		return redirect(action('\Packages\PackageFragmentsController@getList'))
			->withMessagesSuccess([_('Fragment saved successfully')]);
	}


	/**
	 * @param
	 * @return Response
	 */
	public function deleteDelete(Packages\Fragment $fragment)
	{
		$fragment->delete();

		return redirect(action('\Packages\PackageFragmentsController@getList'))
			->withMessagesSuccess([_('Fragment deleted successfully')]);
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
