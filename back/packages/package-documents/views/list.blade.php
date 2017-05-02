@extends('layouts.default')

@section('title') {{ _('Document list') }} @endsection

@section('content')

	<div class="col">
		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ _('Documents') }}</h1>
					<small class="text-muted">{{ _('View documents list') }}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageDocumentsController@getAdd') }}" class="btn btn-primary">{{ _('Create document') }}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<ul class="list-group list-group-lg list-group-sp">

				@foreach($documents as $document)
					<li class="list-group-item">
						<span class="pull-right">
							@if (!$document->is_active)
								<span class="label label-danger m-r-md">{{ _('Disabled') }}</span>
							@endif
							<a href="{{ action('\Packages\PackageDocumentsController@getEdit', $document) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>
						<span class="pull-left"><i class="fa fa-file-pdf-o text-muted fa m-r-sm"></i> </span>
						<div class="clear">
							<a href="{{ action('\Packages\PackageDocumentsController@getEdit', $document) }}">{{ $document->title }}</a>
						</div>
					</li>
				@endforeach

			</ul>

			<div class="text-center">
				{!! $documents->appends(['lang' => \Input::get('lang')])->render() !!}
			</div>

		</div>
	</div>

@endsection
