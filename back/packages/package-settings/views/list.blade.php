@extends('layouts.default')

@section('title') {{_('Settings list')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Settings')}}</h1>
					<small class="text-muted">{{_('View settings list')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageSettingsController@getAdd') }}" class="btn btn-primary">{{_('Create setting')}}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<ul class="list-group list-group-lg list-group-sp">

				@forelse($settings as $setting)

					<li class="list-group-item">
						<span class="pull-right">
							<a href="{{ action('\Packages\PackageSettingsController@getEdit', [$setting]) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>
						<span class="pull-left"><i class="fa fa-cog text-muted fa m-r-sm"></i> </span>
						<div class="clear">
							<a href="{{ action('\Packages\PackageSettingsController@getEdit', [$setting]) }}">{{ $setting->title }}</a>

							<div class="text-muted">
								{{ $setting->name }}: {{ $setting->value }}
							</div>
						</div>
					</li>

				@empty
				@endforelse

			</ul>

		</div>
	</div>

@endsection
