<div class="col-md-12">
		{!! Form::hidden('lang', $lang) !!}
	<div class="form-group">
		{!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}

		{!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('slug', _('Slug'), ['class' => 'control-label']) !!}

		<div class="input-group m-b">
			{!! Form::input('text', 'slug', null, ['class' => 'form-control js-slug', 'data-require' => 'slug', 'data-source' => 'input[name=title]', 'data-locker' => '#slug-locker', 'data-check' => action('\Packages\PackageNewsCategoriesController@getCheckSlug'), 'data-check-status' => '#slug-check-status', 'placeholder' => _('Enter slug')]) !!}

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
		<input type="hidden" name="is_active" value="0">

		<label class="checkbox-inline i-checks">
			{!! Form::checkbox('is_active') !!}<i></i> {{_('is active')}}
		</label>
	</div>

	<div class="form-group">
		<input type="hidden" name="is_top" value="0">

		<label class="checkbox-inline i-checks">
			{!! Form::checkbox('is_top') !!}<i></i> {{_('is top')}}
		</label>
	</div>

</div>

