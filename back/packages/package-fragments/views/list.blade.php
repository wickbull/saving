@extends('layouts.default')

@section('title') {{ _('Fragments list') }} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ _('Fragments') }}</h1>
					<small class="text-muted">{{ _('View fragments list') }}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageFragmentsController@getAdd') }}" class="btn btn-primary">{{ _('Create fragment') }}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">

			{!! inject_tpl(['LanguagesFormBase']) !!}
			
			<ul class="list-group list-group-lg list-group-sp">

				@foreach($fragments as $fragment)
					<li class="list-group-item">
						<span class="pull-right">
							@if (!$fragment->is_active)
								<span class="label label-danger m-r-md">{{ _('Disabled') }}</span>
							@endif
							<a href="{{ action('\Packages\PackageFragmentsController@getEdit', $fragment) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>
						<span class="pull-left"><i class="fa fa-file-o text-muted fa m-r-sm"></i> </span>
						<div class="clear">
							<a href="{{ action('\Packages\PackageFragmentsController@getEdit', $fragment) }}">{{ $fragment->title }}</a>
						</div>
					</li>
				@endforeach

			</ul>

			<div class="text-center">
				{!! $fragments->render() !!}
			</div>

		</div>
	</div>

@endsection
