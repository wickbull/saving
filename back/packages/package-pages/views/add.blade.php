@extends('layouts.default')

@section('title') {{ _('Add page') }} @endsection

@section('body') app-content-body  app-content-full @endsection

@section('content')

	<div class="hbox hbox-auto-xs bg-light">

		<div class="col">
			<div class="vbox">

				<div class="bg-light lter b-b wrapper-md">
					<div class="row">
						<div class="col-md-6">
							<h1 class="m-n font-thin h3 text-black">{{ _('Pages') }}</h1>
							<small class="text-muted">{{ _('Add page') }}</small>
						</div>
					</div>
				</div>

				<div class="row-row">
					<div class="cell">
						<div class="cell-inner">
							<div class="wrapper-md">

								{!! inject_tpl(['LanguagesFormBase']) !!}

								<div class="panel panel-default">
									<div class="panel-body m-t-md">

										{!! Form::open() !!}

											@include ('package-pages::includes.form')

											<div class="line line-dashed b-b line-lg"></div>

											<div class="col-sm-12 text-right">
												<a href="{{ action('\Packages\PackagePagesController@getList') }}" class="btn btn-default">{{ _('Cancel') }}</a>
												<button type="submit" class="btn btn-primary">{{ _('Create Page') }}</button>
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

				@include ('kernel::includes.form-sidebar', [
					'inject_tabs_ids' => ['PagesFormSidebarTabs', 'StoragableFormSidebarTabs'],
					'inject_content_ids' => ['PagesFormSidebarContent', 'StoragableFormSidebarContent'],
					'entity' => null
				])

	</div>
@endsection
