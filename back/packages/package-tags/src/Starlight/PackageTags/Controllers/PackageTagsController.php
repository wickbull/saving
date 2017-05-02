<?php namespace Starlight\PackageTags\Controllers;

use Packages;
use Input;

use Starlight\PackageTags\Requests;

class PackageTagsController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @return Response
	 */
	public function getList()
	{
		if (Input::has('q'))
		{
			$tags = Packages\Tag::where('name', 'LIKE', '%' . Input::get('q') . '%')->orderBy('name')->simplePaginate(50);
		}
		else
		{
			$tags = Packages\Tag::orderBy('name')->simplePaginate(50);
		}

		$grouped_tags = $tags->groupBy(function ($item, $key) {
			return mb_strtoupper(mb_substr($item['name'], 0, 1));
		});

		return view('package-tags::list', [
			'tags' => $tags,
			'grouped_tags' => $grouped_tags
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		return view('package-tags::add');
	}

	/**
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$tag = new Packages\Tag($request->allWithRules());
		$tag->name = trim (mb_strtolower($tag->name));
		$tag->save();

		return redirect(action('\Packages\PackageTagsController@getList'))
			->withMessagesSuccess([_('Tag created successfully')]);
		;
	}

	/**
	 * @return Response
	 */
	public function getEdit(Packages\Tag $tag)
	{
		return view('package-tags::edit', [
			'tag' => $tag
		]);
	}

	/**
	 * @return Response
	 */
	public function postEdit(Packages\Tag $tag, Requests\EditRequest $request)
	{
		$find_tag = Packages\Tag::where('name', '=', $request->name)->where('id', '!=', $tag->id)->first();
		if ($find_tag)
		{
			Packages\Taggable::where('tag_id', '=', $tag->id)->update(['tag_id' => $find_tag->id]);
			$tag->delete();

			return redirect(action('\Packages\PackageTagsController@getList'))
				->withMessagesSuccess([_('Tag has been replaced')]);
		}
		$tag->fill($request->allWithRules());
		$tag->name = trim (mb_strtolower($tag->name));
		$tag->save();

		return redirect(action('\Packages\PackageTagsController@getList'))
			->withMessagesSuccess([_('Tag saved successfully')]);
	}

		/**
	 * @param
	 * @return Response
	 */
	public function deleteDelete(Packages\Tag $tags)
	{
		$tags->delete();

		return redirect(action('\Packages\PackageTagsController@getList'))
			->withMessagesSuccess([_('Tag deleted successfully')]);
	}

}
