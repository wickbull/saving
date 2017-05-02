<?php namespace Starlight\PackageLecturers\Controllers;

use Starlight\PackageLecturers\Requests;
use Input;
use Packages;
use Illuminate\Support\Facades\App;


class PackageLecturersController extends \Starlight\Kernel\Packages\AbstractController {


    /**
     * @return Response
     */
    public function getList()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        if (Input::has('q'))
        {
            $lecturers = Packages\Lecturer::translatedIn($lang)
                ->whereTranslationLike('title', '%' . Input::get('q'). '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
        }
        else
        {
            $lecturers = Packages\Lecturer::translatedIn($lang)
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
        }

        return view('package-lecturers::list', [
            'lecturers' => $lecturers
        ]);
    }

    /**
     * @return Response
     */
    public function getListForSidebar()
    {
        if (Input::has('exclude_id')) {
            $lecturers = Packages\Lecturer::where('id', '!=', Input::get('exclude_id'))
                ->simplePaginate(15);

        } else {
            $lecturers = Packages\Lecturer::simplePaginate(15);
        }

        return view('package-lecturers::inject.list', [
            'lecturers' => $lecturers,
        ]);
    }

    /**
     * @return Response
     */
    public function getAdd()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $front_preview_url = env('FRONT_PREVIEW_EXPERT_URL', '');
        return view('package-lecturers::add', [
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

        $lecturer = new \Packages\Lecturer($request->allWithRules());
        $lecturer->creator_id = \Auth::user()->id;
        $lecturer->editor_id = \Auth::user()->id;
        $lecturer->save();

        $this->handleInjected([
                'LecturersAdd',
                'StoragableAdd',
                'AttachableAdd',
                'ChairsAdd'
            ], $lecturer, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageLecturersController@getEdit', [$lecturer, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('Lecturer created successfully')]);
        }

        return redirect(action('\Packages\PackageLecturersController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('Lecturer created successfully')]);
    }

    /**
     * @param  Packages\Lecturer $lecturer
     * @return Response
     */
    public function getEdit(Packages\Lecturer $lecturer)
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $front_preview_url = env('FRONT_PREVIEW_EXPERT_URL', '');
        return view('package-lecturers::edit', [
            'front_preview_url' => $front_preview_url,
            'lecturer' => $lecturer,
            'lang' => $lang
        ]);
    }

    /**
     * @param  Packages\Lecturer       $lecturer
     * @param  Requests\EditRequest  $request
     * @return Response
     */
    public function postEdit(Packages\Lecturer $lecturer, Requests\EditRequest $request)
    {
        $lang = $request->get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $lecturer->fill($request->allWithRules());
        $lecturer->editor_id = \Auth::user()->id;

        if(!$lecturer->creator_id){
            $lecturer->creator_id = \Auth::user()->id;
        }

        $lecturer->save();

        $this->handleInjected([
                'LecturersEdit',
                'StoragableEdit',
                'AttachableEdit',
                'ChairsEdit'
            ], $lecturer, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageLecturersController@getEdit', [$lecturer, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('Lecturer saved successfully')]);
        }

        return redirect(action('\Packages\PackageLecturersController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('Lecturer saved successfully')]);
    }

    /**
     * @param
     * @return Response
     */
    public function deleteDelete(Packages\Lecturer $lecturer)
    {
        $lecturer->delete();

        return redirect(action('\Packages\PackageLecturersController@getList'))
            ->withMessagesSuccess([_('Lecturer deleted successfully')]);
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
     *
     * @return Response
     */
    public function getSearch()
    {
        $lecturers = Packages\Lecturer::whereTranslationLike('title', '%' . Input::get('q'). '%')
            ->simplePaginate(15);

        return view('package-lecturers::inject.list', [
            'lecturers' => $lecturers,
            'query'    => Input::get('q')
        ]);
    }

    /**
     * @return array
     */
    public function getLecturersByUser(Packages\User $user)
    {
        $lecturers = Packages\Lecturer::whereCreatorId($user->id)
            ->ordered()
            ->with(['creator'])
            ->paginate(15);

        return view('package-lecturers::inject.table-inject', [
            'lecturers' => $lecturers,
            'user' => $user
        ]);
    }

}
