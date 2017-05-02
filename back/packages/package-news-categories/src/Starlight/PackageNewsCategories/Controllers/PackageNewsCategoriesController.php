<?php namespace Starlight\PackageNewsCategories\Controllers;

use Packages;
use Input;
use Illuminate\Support\Facades\App;
use Starlight\PackageNewsCategories\Requests;

class PackageNewsCategoriesController extends \Starlight\Kernel\Packages\AbstractController {

    /**
     * @return Response
     */
    public function getList()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $categories = Packages\NewsCategory::translatedIn($lang)->get();

        return view('package-news-categories::list', [
            'categories' => $categories
        ]);
    }

    /**
     * @return Response
     */
    public function getAdd()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        return view('package-news-categories::add', [
            'lang' => $lang
        ]);
    }

    /**
     * @return Response
     */
    public function postAdd(Requests\AddRequest $request)
    {
        App::make('config')->set('translatable.locale', $request->input('lang'));

        $category = new Packages\NewsCategory($request->allWithRules());

        $category->save();

        return redirect(action('\Packages\PackageNewsCategoriesController@getList'))
            ->withMessagesSuccess([_('Category created successfully')]);
        ;
    }

    /**
     * @return Response
     */
    public function getEdit(Packages\NewsCategory $category)
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        return view('package-news-categories::edit', [
            'news_category' => $category,
            'lang' => $lang
        ]);
    }

    /**
     * @return Response
     */
    public function postEdit(Packages\NewsCategory $category, Requests\EditRequest $request)
    {
        App::make('config')->set('translatable.locale', $request->input('lang'));

        $category->fill($request->allWithRules());

        $category->save();

        return redirect(action('\Packages\PackageNewsCategoriesController@getList'))
            ->withMessagesSuccess([_('Category saved successfully')]);
        ;
    }

    /**
     * @param
     * @return Response
     */
    public function deleteDelete($category)
    {
        $category->delete();

        return redirect(action('\Packages\PackageNewsCategoriesController@getList'))
            ->withMessagesSuccess([_('News Category deleted successfully')]);
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
