@extends('layouts.default')

@section('title') {{_('Create status')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{ _('Statuses') }}</h1>
					<small class="text-muted">{{ _('Create status') }}</small>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<div class="panel panel-default">
				<div class="panel-body m-t-md">

					{!! Form::open() !!}

						@include ('package-statuses::includes.form')

						<div class="line line-dashed b-b line-lg"></div>

						<div class="col-sm-12 text-right">
							<a href="{{ action('\Packages\PackageStatusesController@getList') }}" class="btn btn-default">{{ _('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{_('Create Status')}}</button>
						</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

@endsection
