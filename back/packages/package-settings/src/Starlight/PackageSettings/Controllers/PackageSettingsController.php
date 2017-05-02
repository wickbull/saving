<?php namespace Starlight\PackageSettings\Controllers;

use Request;
use Packages;

use Starlight\PackageSettings\Requests;

class PackageSettingsController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @param  Request $request
	 * @return Response
	 */
	public function getList(Request $request)
	{
		$settings = \Packages\Setting::orderBy('name')->get();

		return view('package-settings::list')
			->withSettings($settings)
		;
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		return view('package-settings::add');
	}

	/**
	 * @param  Request $request
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$setting = new \Packages\Setting($request->allWithRules());

		$setting->save();

		// $this->handleInjected($setting, []);

		return redirect(action('\Packages\PackageSettingsController@getList'))
			->withMessagesSuccess([_('Setting created successfully')]);
		;
	}

	/**
	 * @param  \Packages\Setting $setting
	 * @return Response
	 */
	public function getEdit(Packages\Setting $setting)
	{
		return view('package-settings::edit')
			->withSetting($setting)
		;
	}

	/**
	 * @param  \Packages\Setting $setting
	 * @return Response
	 */
	public function postEdit(Packages\Setting $setting, Requests\EditRequest $request)
	{
		$setting->fill($request->allWithRules());

		$setting->save();

		return redirect(action('\Packages\PackageSettingsController@getList'))
			->withMessagesSuccess([_('Setting updated successfully')]);
		;
	}

}
