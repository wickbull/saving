<?php namespace Starlight\PackageLanguages\Controllers;

use Request;
use Packages;

use Starlight\PackageLanguages\Requests;

class PackageLanguagesController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @param  Request $request
	 * @return Response
	 */
	public function getList(Request $request)
	{
		$languages = \Packages\Language::orderBy('code', 'DESC')->get();

		return view('package-languages::list')
			->withLanguages($languages);
	}

	/**
	 * @return Response
	 */

	// public function getListForSideBar(){
	// 	$languages = \Packages\Language::orderBy('code', 'DESC')->get();

	// 	return view('package-languages::inject.list')
	// 		->withLanguages($languages);

	// }

	public function getAdd()
	{
		return view('package-languages::add');
	}

	/**
	 * @param  Request $request
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$language = new \Packages\Language($request->allWithRules());

		$language->save();

		return redirect(action('\Packages\PackageLanguagesController@getList'))
			->withMessagesSuccess([_('Language created successfully')]);
		;
	}

	/**
	 * @param  \Packages\Language $language
	 * @return Response
	 */
	public function getEdit(Packages\Language $language)
	{
		return view('package-languages::edit')
			->withLanguage($language)
		;
	}

	/**
	 * @param  \Packages\Language $language
	 * @return Response
	 */
	public function postEdit(Packages\Language $language, Requests\EditRequest $request)
	{
		$language->fill($request->allWithRules());

		$language->save();

		return redirect(action('\Packages\PackageLanguagesController@getList'))
			->withMessagesSuccess([_('Language updated successfully')]);
		;
	}

}
