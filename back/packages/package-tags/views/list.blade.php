@extends('layouts.default')

@section('title') {{_('List of tags')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Tags')}}</h1>
					<small class="text-muted">{{_('List of tags')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageTagsController@getAdd') }}" class="btn btn-primary">{{_('Create tag')}}</a>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
				<div class="panel-body b-b b-light">
					<form method="GET" action="{{ action('\Packages\PackageTagsController@getList') }}" class="text-right">
						<input id="filter" type="text" class="form-control input-sm w-lg inline m-r" name="q" value="{{ \Input::get('q') }}" autofocus>
						<button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i> {{ _('Search') }}</button>
					</form>
				</div>

				@foreach($grouped_tags as $letter => $letter_group)
					<h2>{{ $letter }}</h2>
					<div class="panel panel-default">
						<ul class="list-group list-group-lg list-group-sp">
							@foreach (array_chunk($letter_group, 4) as $row_group)
								<div class="row">
									@foreach ($row_group as $tag)
										<div class="col-md-3">
											<li class="list-group-item">
												<span><i class="fa fa-tag text-muted fa m-r-sm"></i> </span>
												<a href="{{ action('\Packages\PackageTagsController@getEdit', [$tag]) }}">
												{{ $tag->name }}
												</a>
											</li>
										</div>
									@endforeach
								</div>
							@endforeach
						</ul>
					</div>
				@endforeach

			<div class="text-center">
				{!! $tags->render() !!}
			</div>
		</div>
	</div>


@endsection
