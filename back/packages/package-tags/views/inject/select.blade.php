<div class="form-group">
	{!! Form::label('tag_name[]', _('Tags'), ['class' => 'control-label']) !!}

	{!! Form::select('tag_name[]', $tags, [], ['class' => 'form-control js-tags', 'data-require' => 'tags', 'multiple', 'placeholder' => _('Select tags')]) !!}
</div>
