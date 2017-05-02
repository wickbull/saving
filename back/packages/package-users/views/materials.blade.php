@extends('layouts.default')

@section('title') {{_("User's materials")}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Users')}}</h1>
					<small class="text-muted">{{_('Materials of')}} {{ $user->first_name }} {{ $user->last_name }}</small>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs js-first-tab-opener" role="tablist" data-require="tabs">
					{!! inject_tpl(['UsersMaterialsTab'], $user) !!}
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					{!! inject_tpl(['UsersMaterialsTabContent'], $user) !!}
				</div>

		</div>
	</div>

@endsection
