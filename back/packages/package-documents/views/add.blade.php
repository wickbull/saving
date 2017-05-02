@extends('layouts.default')

@section('title') {{ _('Add document') }} @endsection

@section('content')

	<div class="hbox hbox-auto-xs bg-light">

		<!-- column -->
		<div class="col">

			<div class="bg-light lter b-b wrapper-md">
				<div class="row">
					<div class="col-md-6">
						<h1 class="m-n font-thin h3 text-black">{{ _('Documents') }}</h1>
						<small class="text-muted">{{ _('Add document') }}</small>
					</div>
				</div>
			</div>

			<div class="wrapper-md">
				<div class="panel panel-default">
					<div class="panel-body m-t-md">

						{!! Form::open() !!}

							@include ('package-documents::includes.form')

							<div class="line line-dashed b-b line-lg"></div>

							<div class="col-sm-12 text-right">
								<a href="{{ action('\Packages\PackageDocumentsController@getList') }}" class="btn btn-default">{{ _('Cancel') }}</a>
								<button type="submit" class="btn btn-primary">{{ _('Create Document') }}</button>
							</div>

						{!! Form::close() !!}

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
