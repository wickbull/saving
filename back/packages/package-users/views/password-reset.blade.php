@extends('layouts.simple')

@section('title') {{ _('Password Reset') }} @endsection

@section('content')

	{!! Form::open() !!}

		<h3 class="text-center">{{ _('Password Reset for') }} </br>{{ $user->first_name }} {{ $user->last_name }}</h3>

		<div class="form-group">
			{!! Form::label('password', _('New password'), ['class' => 'control-label']) !!}
			{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password_confirmation', _('Repeat new password'), ['class' => 'control-label']) !!}
			{!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
		</div>

		<div class="line line-dashed b-b line-lg"></div>

		<div class="col-sm-12 text-center m-b-lg">
			<button type="submit" class="btn btn-primary">{{_('Reset')}}</button>
		</div>

	{!! Form::close() !!}

@endsection

