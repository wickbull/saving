<p>{{ _('Someone requested that the password be reset for the following account on Starlight Control Center:') }}</p>
<p>{{ _('Username:') }} {{ $user->email }}</p>
<p>{{ _('If this was a mistake, just ignore this email and nothing will happen') }}</p>
<p>{{ _('To reset your password, visit the following address:') }} {{ action('\Packages\PackageUsersController@getResetPasswordAction', $token) }}</p>
