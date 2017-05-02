@extends('layouts.default')

@section('title') {{_('List of tags groups')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Tags Groups')}}</h1>
					<small class="text-muted">{{_('List of tags groups')}}</small>
				</div>

				<div class="col-md-6 text-right">
					<a href="{{ action('\Packages\PackageTagsGroupsController@getAdd') }}" class="btn btn-primary">{{_('Create tags group')}}</a>
				</div>
			</div>
		</div>


		<div class="wrapper-md">
			<ul class="list-group list-group-lg list-group-sp">

				@forelse($tags_groups as $tags_group)

					<li class="list-group-item">
						<span class="pull-right text-right">
							@if ($tags_group->is_top)
								<span class="label label-success m-r-md">{{_('Is top')}}</span>
							@endif
							<a href="{{ action('\Packages\PackageTagsGroupsController@getEdit', [$tags_group]) }}"><i class="fa fa-pencil fa-fw m-r-xs"></i></a>
						</span>

						<div class="clear">
							<a href="{{ action('\Packages\PackageTagsGroupsController@getEdit', [$tags_group]) }}">
								{{ $tags_group->title }}
							</a>
						</div>
					</li>

				@empty
				@endforelse

			</ul>

		</div>
	</div>
	<div>
		{!! $tags_groups->render() !!}
	</div>

@endsection
