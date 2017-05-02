@extends('layouts.default')

@section('title') {{ _('Home') }} @endsection

@section('content')
	<!-- main -->
	<div class="col bg-light">
		<div class="wrapper-md bg-white-only b-b">
			<div class="row text-center">

				<div class="col-sm-3 col-xs-6">
					<div>{{ _('News') }}</div>
					<div class="h2 m-b-sm">{{ $count_news }}</div>
				</div>

				<div class="col-sm-3 col-xs-6">
					<div>{{ _('Users') }}</div>
					<div class="h2 m-b-sm">{{ $count_users }}</div>
				</div>

			</div>
		</div>
	</div>
	<!-- / main -->
@endsection
