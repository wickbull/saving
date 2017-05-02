<?php namespace Starlight\PackageStatuses\Controllers;

use Packages;
use Input;

use Starlight\PackageStatuses\Requests;

class PackageStatusesController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @return Response
	 */
	public function getList()
	{
		$statuses = Packages\Status::all();

		return view('package-statuses::list', [
			'statuses' => $statuses
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		return view('package-statuses::add');
	}

	/**
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$status = new Packages\Status($request->allWithRules());

		$status->save();

		return redirect(action('\Packages\PackageStatusesController@getList'))
			->withMessagesSuccess([_('Status created successfully')]);
		;
	}

	/**
	 * @return Response
	 */
	public function getEdit(Packages\Status $status)
	{
		return view('package-statuses::edit', [
			'status' => $status
		]);
	}


	/**
	 * @return Response
	 */
	public function postEdit(Packages\Status $status, Requests\EditRequest $request)
	{
		$status->fill($request->allWithRules());

		$status->save();

		return redirect(action('\Packages\PackageStatusesController@getList'))
			->withMessagesSuccess([_('Status saved successfully')]);
		;
	}


	/**
	 * @return Response
	 */
	public function getCheckSlug()
	{
		return [
			'slug' => Input::get('slug'),
			'exists' => 0
		];
	}

}
