<div class="col-md-12">

	<div class="form-group">
		{!! Form::label('title', _('Title'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'title', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('type', _('Code'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'code', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('type', _('Locale'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'locale', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
	<input type="hidden" name="is_active" value="0">
		{!! Form::label('type', _('is active'), ['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			<label class="checkbox-inline i-checks">
			{!! Form::checkbox('is_active', 1, null, ['class' => 'js-is-active ']) !!}<i></i> 
			</label>
		</div>
	</div>


</div>

