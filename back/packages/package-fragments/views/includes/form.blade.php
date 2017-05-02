<div class="form-group">
	{!! Form::hidden('lang', $lang) !!}
	{!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}
	{!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus']) !!}
</div>

<div class="form-group">
	{!! Form::label('slug', _('Slug'), ['class' => 'control-label']) !!}

	<div class="input-group m-b">
		{!! Form::input('text', 'slug', null, ['class' => 'form-control js-slug', 'data-require' => 'slug', 'data-source' => 'input[name=title]', 'data-locker' => '#slug-locker', 'data-check' => action('\Packages\PackageFragmentsController@getCheckSlug'), 'data-check-status' => '#slug-check-status', 'placeholder' => _('Enter slug')]) !!}

		<label class="input-group-addon" id="slug-check-status">
			<i class="fa fa-pencil text-muted"></i>
		</label>

		<label class="input-group-addon">
			<input type="checkbox" id="slug-locker">
			{{_('manual')}}
		</label>

	</div>

</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
	{!! Form::label('body', _('Body'), ['class' => 'control-label']) !!}
	{!! Form::textarea('body', null, ['class' => 'form-control resize-v js-wysiwyg', 'cols' => 30, 'rows' => 8, 'data-require' => 'wysiwyg', 'data-img-aspect-ratio' => 4/3, 'data-img-max-width' => 900, 'data-img-max-height' => 2000]) !!}
</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
	<input type="hidden" name="is_active" value="0">

	<label class="checkbox-inline i-checks">
		{!! Form::checkbox('is_active', 1, null, ['class' => 'js-is-active']) !!}<i></i> {{ _('is active') }}
	</label>
</div>
