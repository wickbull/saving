<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('name', _('Name'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'name', null, ['class' => 'form-control', 'autofocus']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('title', _('Title'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'title', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('type', _('Type'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'type', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('type', _('Value'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::textarea('value', null, ['class' => 'form-control resize-v', 'cols' => 30, 'rows' => 5, 'autofocus']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('title', _('Lang'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
		{!! Form::select('locale', [
			'uk' => 'ua',
			'ru' => 'ru',
			'en' => 'en'
		], null, ['class' => 'form-control']) !!}
		</div>
	</div>

</div>

