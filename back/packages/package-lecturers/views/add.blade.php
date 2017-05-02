@extends('layouts.default')

@section('title') {{_('Lecturer add')}} @endsection

@section('body') app-content-body  app-content-full @endsection

@section('content')

	<div class="hbox hbox-auto-xs bg-light">

		<!-- column -->
		<div class="col">
			<div class="vbox">

				<div class="bg-light lter b-b wrapper-md">
					<div class="row">
						<div class="col-md-6">
							<h1 class="m-n font-thin h3 text-black">{{ _('Lecturers') }}</h1>
							<small class="text-muted">{{ _('Add lecturer') }}</small>
						</div>

					</div>
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
														{{ _('New lecturer') }}
													</a>
												</li>

												{!! inject_tpl(['AttachableFormPrimaryTabsNav'], null) !!}

											</ul>
										</div>
										<!-- /Tab buttons -->

										{!! Form::open(['class' => 'js-primary-form']) !!}

											<!-- Tabs -->
											<div class="tab-content m-t-md">
												<div class="tab-pane active" id="primary-form">
													@include ('package-lecturers::includes.form')
												</div>

												{!! inject_tpl(['AttachableFormPrimaryTabsContant'], null) !!}

											</div>
											<!-- /Tabs -->

											<div class="line line-dashed b-b line-lg"></div>

											<div class="col-sm-12 text-right">
												<!-- Preview -->
												@if(!empty($front_preview_url))
													<button type="submit" formtarget="_blank" formaction="{{ $front_preview_url }}" class="btn btn-success">{{ _('Preview') }}</button>
												@endif
												<!-- /Preview -->

												<a href="{{ action('\Packages\PackageLecturersController@getList', ['lang' => $lang ?: 'uk']) }}" class="btn btn-default">{{ _('Cancel') }}</a>

												<button type="submit" class="btn btn-info" name="next_action" value="save_and_close">{{ _('Create and close') }}</button>
												<button type="submit" class="btn btn-primary" name="next_action" value="save">{{ _('Create new lecturer') }}</button>
											</div>

											{!! Form::hidden('lang', $lang) !!}

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
			'inject_tabs_ids' => ['StoragableFormSidebarTabs'],
			'inject_content_ids' => ['StoragableFormSidebarContent'],
			'entity' => null
		])

	</div>

@endsection
