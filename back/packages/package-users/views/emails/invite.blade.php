<p>{{ _('You were invited to Starlight Control Center as administrator.') }}</p>
<p>{{ _('Username:') }} {{ $user->email }}</p>
<p>{{ _('If this was a mistake, just ignore this email and nothing will happen') }}</p>
<p>{{ _('To confirm this action, visit the following address:') }} {{ action('\Packages\PackageUsersController@getInviteAction', $token) }}</p>
