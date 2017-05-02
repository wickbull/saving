@extends('layouts.default')

@section('title') {{_('Edit User')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">

				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('User')}}</h1>
					<small class="text-muted">{{_('Edit user')}}</small>
				</div>

				<div class="pull-right padder">
					{!! Form::open(['method' => 'DELETE', 'url' => action('\Packages\PackageUsersController@deleteDelete', $user)]) !!}
						<button class="btn btn-danger">{{_('Delete user')}}</button>
					{!! Form::close() !!}
				</div>

			</div>
		</div>

		<div class="wrapper-md">
			<div class="panel panel-default">
				<div class="panel-body m-t-md">

					{!! Form::model($user) !!}

						@include ('package-users::includes.form')

						<div class="line line-dashed b-b line-lg"></div>

						<div class="col-sm-12 text-right">
							<div class="btn-group pull-left">

								<button type="submit" formaction="{{ action('\Packages\PackageUsersController@postSendResetPasswordAction', $user) }}" class="btn btn-warning" data-confirm="{{ _('Are you sure to reset password for this user?') }}">{{_('Reset password')}}</button>

								@if (! $user->haveTeam('administrators') && $user->password)
									<button type="submit" formaction="{{ action('\Packages\PackageUsersController@postSendInviteAction', $user) }}" class="btn btn-primary" data-confirm="{{ _('Are you sure to invite this user as administrator?') }}">{{_('Invite as administrator')}}</button>
								@endif

							</div>

							<a href="{{ action('\Packages\PackageUsersController@getList') }}" class="btn btn-default">{{_('Cancel')}}</a>
							<button type="submit" class="btn btn-primary">{{_('Save changes')}}</button>
						</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

@endsection
