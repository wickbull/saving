<?php namespace Starlight\PackageNews\Controllers;

use Starlight\PackageNews\Requests;
use Input;
use Packages;
use Illuminate\Support\Facades\App;

class PackageNewsController extends \Starlight\Kernel\Packages\AbstractController {

    /**
     * @return Response
     */
    public function getList()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        if (Input::has('q')) {
            $news = Packages\News::translatedIn($lang)->whereTranslationLike('title', '%' . Input::get('q'). '%')->orderBy('publish_at', 'DESC')->paginate(15);
        } else {
            $news = Packages\News::translatedIn($lang)->orderBy('publish_at', 'DESC')->paginate(15);
        }

        return view('package-news::list', [
            'news' => $news
        ]);
    }

    /**
     * @return Response
     */
    public function getAdd()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);
        $front_preview_url = env('FRONT_PREVIEW_PUBLICATION_URL', '');

        return view('package-news::add', [
            'front_preview_url' => $front_preview_url,
            'lang' => $lang
        ]);
    }

    /**
     * @param  Requests\AddRequest $request
     * @return Response
     */
    public function postAdd(Requests\AddRequest $request)
    {
        $lang = $request->get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $news = new \Packages\News($request->allWithRules());
        $news->creator_id = \Auth::user()->id;
        $news->editor_id = \Auth::user()->id;
        $news->save();

        $this->handleInjected([
                'PublicationsAdd',
                'NewsAdd',
                'StatusesAdd',
                'TagsAdd',
                'LecturersAdd',
                'ChairsAdd',
                'LaboratoriesAdd',
                'NewsCategoryAdd',
                'StoragableAdd',
                'GalleriableAdd'
            ], $news, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageNewsController@getEdit', [$news, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('News created successfully')]);
        }

        return redirect(action('\Packages\PackageNewsController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('News created successfully')]);
    }

    /**
     * @param  Packages\News $news
     * @return Response
     */
    public function getEdit(Packages\News $news)
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);
        $front_preview_url = env('FRONT_PREVIEW_PUBLICATION_URL', '');

        return view('package-news::edit', [
            'front_preview_url' => $front_preview_url,
            'news' => $news,
            'lang' => $lang
        ]);
    }

    /**
     * @param  Packages\News       $news
     * @param  Requests\EditRequest  $request
     * @return Response
     */
    public function postEdit(Packages\News $news, Requests\EditRequest $request)
    {
        $lang = $request->get('lang');

        App::make('config')->set('translatable.locale', $lang);
        $news->fill($request->allWithRules());
        $news->editor_id = \Auth::user()->id;

        if(!$news->creator_id){
            $news->creator_id = \Auth::user()->id;
        }

        $news->save();

        $this->handleInjected([
                'PublicationsEdit',
                'NewsEdit',
                'StatusesEdit',
                'TagsEdit',
                'ChairsEdit',
                'LecturersEdit',
                'LaboratoriesEdit',
                'NewsCategoryEdit',
                'StoragableEdit',
                'GalleriableEdit'
            ], $news, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageNewsController@getEdit', [$news, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('News saved successfully')]);
        }

        return redirect(action('\Packages\PackageNewsController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('News saved successfully')]);

    }


    /**
     * @param
     * @return Response
     */
    public function deleteDelete(Packages\News $news, Requests\DeleteRequest $request)
    {
        $this->handleInjected([
                'PublicationsDelete',
                'NewsDelete',
                'ChairsDelete',
                'LecturersDelete',
                'LaboratoriesDelete'
            ], $news, $request);

        $news->delete();

        return redirect(action('\Packages\PackageNewsController@getList'))
            ->withMessagesSuccess([_('News deleted successfully')]);
        ;
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

    /**
     * @return array
     */
    public function getNewsByUser(Packages\User $user)
    {
        $news = Packages\News::whereCreatorId($user->id)
            ->ordered()
            ->with(['creator'])
            ->paginate(15);

        return view('package-news::inject.table-inject', [
            'news' => $news,
            'user' => $user
        ]);
    }


}
