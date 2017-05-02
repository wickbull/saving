<?php namespace Starlight\PackageNewsRelated\Controllers;

use Packages;
use Input;

use Starlight\PackageNewsRelated\Requests;
use Illuminate\Support\Facades\App;

class PackageNewsRelatedController extends \Starlight\Kernel\Packages\AbstractController {

    /**
     * @return Response
     */
    public function getList()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        if (Input::has('exclude_id')) {
            $news = Packages\News::translatedIn($lang)
                ->where('id', '!=', Input::get('exclude_id'))
                ->ordered()
                ->simplePaginate(15);

        } else {
            $news = Packages\News::translatedIn($lang)
                ->ordered()
                ->simplePaginate(15);
        }

        return view('package-news-related::list', [
            'news' => $news,
        ]);
    }

    /**
     *
     * @return Response
     */
    public function getSearch()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        if (Input::has('exclude_id')) {
            $news = Packages\News::where('id', '!=', Input::get('exclude_id'))
                ->where('title', 'LIKE', '%' . Input::get('q') . '%')
                ->ordered()
                ->simplePaginate(15);

        } else {
            $news = Packages\News::translatedIn($lang)
                ->whereTranslationLike('title', 'LIKE', '%' . Input::get('q') . '%')
                ->ordered()
                ->simplePaginate(15);
        }

        return view('package-news-related::list', [
            'news'  => $news,
            'query' => Input::get('q')
        ]);
    }


}
