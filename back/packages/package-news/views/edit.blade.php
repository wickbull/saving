@extends('layouts.default')

@section('title') {{_('News edit')}} @endsection

@section('body') app-content-body  app-content-full @endsection

@section('content')



    <div class="hbox hbox-auto-xs bg-light">

        <!-- column -->
        <div class="col">
            <div class="vbox">

                <div class="bg-light lter b-b wrapper-md">

                    <div class="pull-right padder">
                        {!! Form::open(['method' => 'DELETE', 'url' => action('\Packages\PackageNewsController@deleteDelete', $news)]) !!}
                            <button class="btn btn-danger">{{ _('Delete news') }}</button>
                        {!! Form::close() !!}
                    </div>

                    <h1 class="m-n font-thin h3 text-black">{{ _('News') }}</h1>
                    <small class="text-muted">{{ _('Edit news' )}}</small>
                </div>

                <div class="row-row">
                    <div class="cell">
                        <div class="cell-inner">
                            <div class="wrapper-md">

                                    {!! inject_tpl(['LanguagesFormBase']) !!}

                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <!-- Tab buttons -->
                                        <div class="nav-tabs-alt m-b-xs">
                                            <ul class="nav nav-tabs js-right-sidebar-tabs" role="tablist">
                                                <li class="active">
                                                    <a href="#primary-form" data-toggle="tab" aria-expanded="true">
                                                        {{ _('Main form') }}
                                                    </a>
                                                </li>

                                                {{-- {!! inject_tpl(['GalleriableFormPrimaryTabsNav'], $news) !!} --}}

                                            </ul>
                                        </div>
                                        <!-- /Tab buttons -->


                                        {!! Form::model($news, ['class' => 'js-primary-form']) !!}

                                            <!-- Tabs -->
                                            <div class="tab-content m-t-md">
                                                <div class="tab-pane active" id="primary-form">
                                                    @include ('package-news::includes.form')
                                                </div>

                                                {{-- {!! inject_tpl(['GalleriableFormPrimaryTabsContant'], $news) !!} --}}

                                            </div>
                                            <!-- /Tabs -->

                                            <div class="line line-dashed b-b line-lg"></div>

                                            <div class="col-sm-12 text-right">
                                                @if(!empty($front_preview_url))
                                                    <button type="submit" formtarget="_blank" formaction="{{ $front_preview_url }}" class="btn btn-success ">{{ _('Preview') }}</button>
                                                @endif
                                                <a href="{{ action('\Packages\PackageNewsController@getList', ['lang' => $lang ?: 'uk']) }}" class="btn btn-default">{{ _('Cancel') }}</a>
                                                <button type="submit" class="btn btn-info" name="next_action" value="save_and_close">{{_('Save and close')}}</button>

                                                <button type="submit" class="btn btn-primary" name="next_action" value="save">{{ _('Save news') }}</button>

                                            </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /column -->

        @include ('kernel::includes.form-sidebar', [
            'inject_tabs_ids' => [
                'NewsFormSidebarTabs',
                'PublicationsFormSidebarTabs',
                'LecturersFormSidebarTabs',
                'LaboratoriesFormSidebarTabs',
                'ChairsFormSidebarTabs',
                'StoragableFormSidebarTabs'
            ],
            'inject_content_ids' => [
                'NewsFormSidebarContent',
                'PublicationsFormSidebarContent',
                'LecturersFormSidebarContent',
                'LaboratoriesFormSidebarContent',
                'ChairsFormSidebarContent',
                'StoragableFormSidebarContent'
            ],
            'entity' => $news
        ])

    </div>

@endsection
