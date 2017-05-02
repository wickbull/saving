@if ($user->canBeEditedBy(Auth::user()))

	<div class="wrapper bg-white b-b">
		<ul class="nav nav-pills nav-sm">

			<li @if ($active === 'overview') class="active" @endif>
				<a href="{{ action('UserController@getProfile', [$user]) }}">
					{{ _('Overview') }}
				</a>
			</li>

			<li @if ($active === 'edit') class="active" @endif>
				<a href="{{ action('UserController@getEdit', [$user]) }}">
					{{ _('Edit Profile') }}
				</a>
			</li>

			<li @if ($active === 'settings') class="active" @endif>
				<a href="{{ action('UserController@getSettings', [$user]) }}">
					{{ _('Account Settings') }}
				</a>
			</li>

			{{-- <li @if ($active === 'generate') class="active" @endif>
				<a href="{{ action('DocumentController@getGenerateList', [$user]) }}">
					Document Maker
				</a>
			</li> --}}

		</ul>
	</div>

@endif
