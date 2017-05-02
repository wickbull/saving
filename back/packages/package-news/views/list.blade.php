@extends('layouts.default')

@section('title') {{_('News list')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('News')}}</h1>
					<small class="text-muted">{{_('View news list')}}</small>

				</div>


				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageNewsController@getAdd') }}" class="btn btn-primary">{{_('Create news')}}</a>
				</div>
			</div>
		</div>



		<div class="wrapper-md">

			{!! inject_tpl(['LanguagesFormBase']) !!}

			<div class="panel-body b-b b-light">
				<form method="GET" action="{{ action('\Packages\PackageNewsController@getList') }}" class="text-right">
					<input id="filter" type="text" class="form-control input-sm w-lg inline m-r" name="q" value="{{ \Input::get('q') }}">
					@if(Input::has('lang')) <input type="hidden" value="{{ Input::get('lang') }}" name="lang">@endif
					<button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i> {{ _('Search') }}</button>
				</form>
			</div>
			<div>
				<table class="table m-b-none footable-loaded footable default table-striped" ui-jq="footable">

					@include ('package-news::includes.table', ['news' => $news])

				</table>
			</div>

		</div>

	</div>

@endsection
