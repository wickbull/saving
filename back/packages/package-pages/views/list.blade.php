@extends('layouts.default')

@section('title') {{ _('Pages list') }} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ _('Pages') }}</h1>
					<small class="text-muted">{{ _('View pages list') }}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackagePagesController@getAdd') }}" class="btn btn-primary">{{ _('Create page') }}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">

			{!! inject_tpl(['LanguagesFormBase']) !!}
			
			<ul class="list-group list-group-lg list-group-sp">

				@foreach($pages as $page)
					<li class="list-group-item">
						<span class="pull-right">
							@if (!$page->is_active)
								<span class="label label-danger m-r-md">{{ _('Disabled') }}</span>
							@endif
							<a href="{{ action('\Packages\PackagePagesController@getEdit', $page) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>
						<span class="pull-left"><i class="fa fa-file-o text-muted fa m-r-sm"></i> </span>
						<div class="clear">
							<a href="{{ action('\Packages\PackagePagesController@getEdit', $page) }}">{{ $page->title }}</a>
						</div>
					</li>
				@endforeach

			</ul>

			<div class="text-center">
				{!! $pages->render() !!}
			</div>

		</div>
	</div>

@endsection
