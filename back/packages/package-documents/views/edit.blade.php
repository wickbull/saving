@extends('layouts.default')

@section('title') {{ _('Edit document') }} @endsection

@section('content')

	<div class="hbox hbox-auto-xs bg-light">

		<!-- column -->
		<div class="col">

			<div class="bg-light lter b-b wrapper-md">
				<div class="row">
					<div class="col-md-6">
						<h1 class="m-n font-thin h3 text-black">{{ _('Documents') }}</h1>
						<small class="text-muted">{{ _('Edit document') }}</small>
					</div>
					<div class="pull-right padder">
						{!! Form::open(['method' => 'DELETE', 'url' => action('\Packages\PackageDocumentsController@deleteDelete', $document)]) !!}
							<button class="btn btn-danger">{{ _('Delete document') }}</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

			<div class="wrapper-md">

				{!! inject_tpl(['LanguagesFormBase']) !!}

				<div class="panel panel-default">
					<div class="panel-body m-t-md">

						{!! Form::model($document) !!}

							{!! Form::hidden('lang', $lang) !!}

							@include ('package-documents::includes.form')

							<div class="line line-dashed b-b line-lg"></div>

							<div class="col-sm-12 text-right">
								<a href="{{ action('\Packages\PackageDocumentsController@getList') }}" class="btn btn-default">{{ _('Cancel') }}</a>
								<button type="submit" class="btn btn-primary">{{ _('Save changes') }}</button>
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
