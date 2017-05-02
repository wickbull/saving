@extends('layouts.default')

@section('title') {{_('Add language')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Languages')}}</h1>
					<small class="text-muted">{{_('Add language')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageLanguagesController@getList') }}" class="btn btn-default">{{_('Return back')}}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<div class="panel panel-default">
				<div class="panel-body m-t-md">

					{!! Form::open(['class' => 'form-horizontal']) !!}



						@include ('package-languages::includes.form')

						<div class="line line-dashed b-b line-lg"></div>

						<div class="col-sm-12 text-right">
							<a href="{{ action('\Packages\PackageLanguagesController@getList') }}" class="btn btn-default">{{_('Cancel')}}</a>
							<button type="submit" class="btn btn-primary">{{_('Save changes')}}</button>
						</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>

	</div>

@endsection
