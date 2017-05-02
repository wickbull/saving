<div class="col-md-12">

	<div class="form-group">
		{!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}

		{!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('slug', _('Slug'), ['class' => 'control-label']) !!}

		<div class="input-group m-b">
			{!! Form::input('text', 'slug', null, ['class' => 'form-control js-slug', 'data-require' => 'slug', 'data-source' => 'input[name=title]', 'data-locker' => '#slug-locker', 'data-check' => action('\Packages\PackageStatusesController@getCheckSlug'), 'data-check-status' => '#slug-check-status', 'placeholder' => _('Enter slug')]) !!}

			<label class="input-group-addon" id="slug-check-status">
				<i class="fa fa-pencil text-muted"></i>
			</label>

			<label class="input-group-addon">
				<input type="checkbox" id="slug-locker">
				{{ _('manual') }}
			</label>

		</div>

	</div>

</div>

