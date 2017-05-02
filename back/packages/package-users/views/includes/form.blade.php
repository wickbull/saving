{!! inject_tpl(['StoragableFormBase'], isset($user) ? $user : "Packages\User") !!}

<div class="form-group">
	{!! Form::label('email', _('Email'), ['class' => 'control-label']) !!}
	{!! Form::input('text', 'email', null, ['class' => 'form-control', 'autofocus']) !!}
</div>

@if (Route::currentRouteName() !== 'usersEdit')
	<div class="form-group">
		{!! Form::label('password', _('Password'), ['class' => 'control-label']) !!}
		{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password_confirmation', _('Repeat password'), ['class' => 'control-label']) !!}
		{!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
	</div>
@endif

<div class="form-group">
	{!! Form::label('first_name', _('First name'), ['class' => 'control-label']) !!}
	{!! Form::input('text', 'first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('last_name', _('Last name'), ['class' => 'control-label']) !!}
	{!! Form::input('text', 'last_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('descr', _('Description'), ['class' => 'control-label']) !!}
	{!! Form::textarea('descr', null, ['class' => 'form-control resize-v js-wysiwyg', 'cols' => 30, 'rows' => 8, 'data-require' => 'wysiwyg', 'data-img-aspect-ratio' => 4/3, 'data-img-max-width' => 900, 'data-img-max-height' => 2000]) !!}
</div>

{!! inject_tpl(['UsersFormBase'], isset($user) ? $user : "Packages\User") !!}
