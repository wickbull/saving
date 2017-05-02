<?php
namespace Starlight\PackageLecturers;

use Carbon\Carbon;
use Packages;
use Input;

class PackageLecturersServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

    /**
     * @var boolean
     */
    protected $migrations = true;

    /**
     * @var array
     */
    protected $controllers = ['PackageLecturersController'];

    /**
     * @var array
     */
    protected $models = ['Lecturer', 'LecturerTranslation'];

    /**
     * @return void
     */
    public function init()
    {
        $this->addSidebarControl('Lecturers', '\Packages\PackageLecturersController@getList', [
            'title' => _('Lecturers'),
            'icon'  => 'users',
        ]);


        $this->registerInjectTpl(['LecturersFormBase'], 'package-lecturers::inject.form-list', function ($entity)
        {
            if (old('lecturers_id'))
                return ['lecturers_related' => \Packages\Lecturer::whereIn('id', old('lecturers_id'))->get()];

            return ['lecturers_related' => $entity ? $entity->morphTomany('\Packages\Lecturer', 'lecturerable')->get() : []];
        });

        $this->registerInjectHandler(['LecturersAdd', 'LecturersEdit'], function ($entity, $request)
        {
            $lecturers_ids = $request->get('lecturers_id');

            $entity->morphToMany('\Packages\Lecturer', 'lecturerable')->sync($lecturers_ids ?: []);
        });

        $this->registerInjectHandler(['LecturersDelete'], function ($entity, $request)
        {
            $entity->morphToMany('\Packages\Lecturer', 'lecturerable')->sync([]);
        });

        $this->registerInjectRules(['LecturersAdd', 'LecturersEdit'],
        [
            'lecturers_id' => 'array|each:exists,lecturers,id'
        ]);

        $this->registerInjectTpl(['LecturersFormSidebarTabs'], 'package-lecturers::inject.form-sidebar-tab', function ($entity)
        {
            return [];
        });

        $this->registerInjectTpl(['LecturersFormSidebarContent'], 'package-lecturers::inject.form-sidebar-content', function ($entity)
        {
            return [];
        });

        $this->registerInjectTpl(['MainLecturerFormBase'], 'package-lecturers::inject.select', function ($entity) {

            $lang = Input::get('lang');
            $lecturers = Packages\Lecturer::translatedIn($lang)->get()->lists('title', 'id');

            if (old('lecturers')) {
                return [
                    'lecturers'  => $lecturers,
                    'selected'   => old('lecturers')
                ];
            } else {
                return [
                    'lecturers'  => $lecturers,
                    'selected'   => $entity ? $entity->morphToMany('\Packages\Lecturer', 'lecturerable')->lists('id') : null
                ];
            }

        });

        $this->registerInjectTpl(['UsersMaterialsTab'], 'package-lecturers::inject.tab', function ($entity)
        {
            return ['user' => $entity];
        });

        $this->registerInjectTpl(['UsersMaterialsTabContent'], 'package-lecturers::inject.tab-content', function ($entity)
        {
            return ['user' => $entity];
        });
    }

}
