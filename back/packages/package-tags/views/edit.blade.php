@extends('layouts.default')

@section('title') {{_('Edit tag')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="pull-right padder">
				{!! Form::open(['method' => 'DELETE', 'url' => action('\Packages\PackageTagsController@deleteDelete', $tag)]) !!}
					<button class="btn btn-danger">{{_('Delete tag')}}</button>
				{!! Form::close() !!}
			</div>

			<h1 class="m-n font-thin h3 text-black">{{_('Tags')}}</h1>
			<small class="text-muted">{{_('Edit tag')}}</small>
		</div>

		<div class="wrapper-md">
			<div class="panel panel-default">
				<div class="panel-body m-t-md">

					{!! Form::model($tag) !!}

						@include ('package-tags::includes.form')

						<div class="line line-dashed b-b line-lg"></div>

						<div class="col-sm-12 text-right">
							<a href="{{ action('\Packages\PackageTagsController@getList') }}" class="btn btn-default">{{_('Cancel')}}</a>
							<button type="submit" class="btn btn-primary">{{_('Save changes')}}</button>
						</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

@endsection
