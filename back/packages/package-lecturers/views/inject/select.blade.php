<div class="form-group">
    {!! Form::label('lecturers_id[]', _('Main lecturer'), ['class' => 'control-label']) !!}

    {!! Form::select('lecturers_id[]', $lecturers, $selected, ['class' => 'form-control js-chosen col-xs-12', 'data-require' => 'chosen', 'data-placeholder' => _('Select lecturer')]) !!}
</div>
