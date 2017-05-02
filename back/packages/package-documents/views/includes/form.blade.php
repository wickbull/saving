<div class="form-group">
	{!! Form::label('title', _('Title'), ['class' => 'control-label']) !!}
	{!! Form::input('text', 'title', null, ['class' => 'form-control', 'autofocus']) !!}
</div>

<div class="line line-dashed b-b line-lg"></div>

{!! inject_tpl(['StoragableFormBase'], isset($document) ? $document : 'Packages\Document') !!}

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
	{!! Form::label('publish_at', _('Publication time'), ['class' => 'control-label']) !!}

	<div class="input-group w-md">

		{!! Form::input('text', 'publish_at', isset($document) ? $document->publish_at->format('d.m.Y') : \Carbon\Carbon::now()->format('d.m.Y'), ['class' => 'form-control w-md js-datepicker js-publish-time', 'data-require' => 'datepicker', 'data-drops' => 'up', 'data-format' => 'DD.MM.YYYY', 'required' => 'required']) !!}

	</div>
</div>

<div class="line line-dashed b-b line-lg"></div>

<div class="form-group">
	<input type="hidden" name="is_active" value="0">

	<label class="checkbox-inline i-checks">
		{!! Form::checkbox('is_active', 1, 1, ['class' => 'js-is-active']) !!}<i></i> {{ _('is active') }}
	</label>
</div>
