<div class="form-group">
	{!! Form::label('news_category_id[]', _('Categories'), ['class' => 'control-label']) !!}

	{!! Form::select('news_category_id[]', $categories, $selected, ['class' => 'form-control js-chosen col-xs-12', 'data-require' => 'chosen', 'multiple', 'data-placeholder' => _('Select categories')]) !!}
</div>
