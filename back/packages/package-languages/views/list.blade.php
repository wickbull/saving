@extends('layouts.default')

@section('title') {{_('Languages list')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Languages')}}</h1>
					<small class="text-muted">{{_('View languages list')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageLanguagesController@getAdd') }}" class="btn btn-primary">{{_('Create language')}}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<ul class="list-group list-group-lg list-group-sp">

				@forelse($languages as $language)

					<li class="list-group-item">
						<span class="pull-right">
							@if ($language->is_active)
								<span class="label label-success m-r-md">{{_('Is active')}}</span>
							@endif
							<a href="{{ action('\Packages\PackageLanguagesController@getEdit', [$language]) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>
						<span class="pull-left"><i class="fa fa-cog text-muted fa m-r-sm"></i> </span>
						<div class="clear">
							<a href="{{ action('\Packages\PackageLanguagesController@getEdit', [$language]) }}">{{ $language->title }}</a>

							<div class="text-muted">
								{{ $language->code }}: {{ $language->locale }}
							</div>
						</div>
					</li>

				@empty
				@endforelse

			</ul>

		</div>
	</div>

@endsection
