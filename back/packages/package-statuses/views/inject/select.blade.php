<div class="form-group">
	{!! Form::label('status_id[]', _('Statuses'), ['class' => 'control-label']) !!}

	{!! Form::select('status_id[]', $statuses, $selected, ['class' => 'form-control js-chosen col-xs-12', 'data-require' => 'chosen', 'multiple', 'data-placeholder' => _('Select statuses')]) !!}
</div>
