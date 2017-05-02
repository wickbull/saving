@extends('layouts.default')

@section('title') {{ _('Slider edit') }} @endsection

@section('body') app-content-body  app-content-full @endsection

@section('content')

    <div class="hbox hbox-auto-xs bg-light">

        <!-- column -->
        <div class="col">
            <div class="vbox">

                <div class="bg-light lter b-b wrapper-md">
                    <div class="pull-right padder">
                        {!! Form::open(['method' => 'DELETE', 'url' => action('\Packages\PackageSlidersController@deleteDelete', $slider)]) !!}
                            <button class="btn btn-danger">{{ _('Delete slider') }}</button>
                        {!! Form::close() !!}
                    </div>

                    <h1 class="m-n font-thin h3 text-black">{{ _('Sliders') }}</h1>
                    <small class="text-muted">{{ _('Edit slider') }}</small>
                </div>

                <div class="row-row">
                    <div class="cell">
                        <div class="cell-inner">
                            <div class="wrapper-md">

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

                                                <li>
                                                    <a href="#gallery-form" data-toggle="tab" aria-expanded="true">
                                                        {{ _('Gallery') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /Tab buttons -->

                                        {!! Form::model($slider, ['class' => 'js-garlic']) !!}

                                            <!-- Tabs -->
                                            <div class="tab-content m-t-md">
                                                <div class="tab-pane active" id="primary-form">
                                                    @include ('package-sliders::includes.form')
                                                </div>

                                                <div class="tab-pane" id="gallery-form">
                                                    {!! inject_tpl(['GalleriableFormPrimaryTabsContant'], isset($slider) ? $slider : "Packages\Slider") !!}
                                                </div>
                                            </div>
                                            <!-- /Tabs -->

                                            <div class="line line-dashed b-b line-lg"></div>

                                            <div class="col-sm-12 text-right">
                                                <a href="{{ action('\Packages\PackageSlidersController@getList') }}" class="btn btn-default">{{ _('Cancel') }}</a>
                                                <button type="submit" class="btn btn-primary">{{ _('Save slider') }}</button>
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

    </div>

@endsection
