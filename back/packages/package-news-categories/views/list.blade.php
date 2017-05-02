@extends('layouts.default')

@section('title') {{_('List of news categories')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('New Categories')}}</h1>
					<small class="text-muted">{{_('List of news categories')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageNewsCategoriesController@getAdd') }}" class="btn btn-primary">{{_('Create news category')}}</a>
				</div>
			</div>
		</div>


		<div class="wrapper-md">

			{!! inject_tpl(['LanguagesFormBase']) !!}

			<ul class="list-group list-group-lg list-group-sp">

				@forelse($categories as $category)

					<li class="list-group-item">
						<span class="pull-right text-right">
							@unless ($category->is_active)
								<span class="label label-danger m-r-md">{{_('Disabled')}}</span>
							@endunless

							@if ($category->is_top)
								<span class="label label-success m-r-md">{{_('Top')}}</span>
							@endif

							<a href="{{ action('\Packages\PackageNewsCategoriesController@getEdit', [$category]) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>

						<div class="clear">
							<a href="{{ action('\Packages\PackageNewsCategoriesController@getEdit', [$category]) }}">
								{{ $category->title }}
							</a>
						</div>
					</li>

				@empty
				@endforelse

			</ul>

		</div>
	</div>

@endsection
