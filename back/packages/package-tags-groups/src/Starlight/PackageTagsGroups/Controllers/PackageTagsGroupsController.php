<?php namespace Starlight\PackageTagsGroups\Controllers;

use Packages;
use Input;

use Starlight\PackageTagsGroups\Requests;

class PackageTagsGroupsController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @return Response
	 */
	public function getList()
	{
		$tags_groups = Packages\TagsGroup::orderBy('is_top', 'DESC')->simplePaginate(15);

		return view('package-tags-groups::list', [
			'tags_groups' => $tags_groups
			]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		if(old('tags_name'))
		{
			return view('package-tags-groups::add', [
				'tags' => array_flip(old('tags_name')),
			]);
		}
		else
		{
			return view('package-tags-groups::add');
		}
	}

	/**
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$tags_group = new Packages\TagsGroup($request->allWithRules());
		$tags_group->save();

		$ids = [];
		if ($request->has('tags_name'))
		{
			$tags_name = $request->get('tags_name');
			$ids = Packages\Tag::whereIn('name', $tags_name ?: [])->lists('id');
		}

		$tags_group->belongsToMany('\Packages\Tag')->sync($ids ?: []);

		return redirect(action('\Packages\PackageTagsGroupsController@getList'))
			->withMessagesSuccess([_('Group tags created successfully')]);
	}

	/**
	 * @return Response
	 */
	public function getEdit(Packages\TagsGroup $tags_group)
	{
		if(old('tags_name'))
		{
			return view('package-tags-groups::edit', [
				'tags_group' => $tags_group,
				'tags' => array_flip(old('tags_name')),
			]);
		}
		else
		{
			return view('package-tags-groups::edit', [
				'tags_group' => $tags_group,
				'tags' => $tags_group->belongsToMany('Packages\Tag')->lists('name','name'),
			]);
		}
	}

	/**
	 * @return Response
	 */
	public function postEdit(Packages\TagsGroup $tags_group, Requests\EditRequest $request)
	{
		$tags_group->fill($request->allWithRules());

		$tags_group->save();

		$ids = [];
		if ($request->has('tags_name'))
		{
			$tags_name = $request->get('tags_name');
			$ids = Packages\Tag::whereIn('name', $tags_name ?: [])->lists('id');
		}

		$tags_group->belongsToMany('\Packages\Tag')->sync($ids ?: []);

		return redirect(action('\Packages\PackageTagsGroupsController@getList'))
			->withMessagesSuccess([_('Group tags saved successfully')]);
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

	/**
	 * @return Response
	 */
	public function getListTags()
	{
		if(\Request::has('name'))
		{
			$tags = Packages\Tag::where('name', 'like', \Request::get('name').'%')->limit(15)->get();
			return $tags;
		}
		else
		{
			return [];
		}
	}

}
