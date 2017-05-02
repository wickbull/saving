<div class="form-group">

	<label for="publish_at" class="control-label">{{_('Lecturers:')}}</label>

	<div class="js-nothing-in-related @if ($lecturers_related && $lecturers_related->count()) hide @endif" >
		<p class="text-muted">{{ _('Nothing to show') }}</p>
	</div>

	<ul class="list-group list-group-lg list-group-sp js-lecturers-form-list">
		@foreach ($lecturers_related as $lecturer_related)
			<li class="list-group-item" data-id="{{ $lecturer_related->id }}">
				<span class="pull-right">
					<label class="i-switch i-switch-md bg-success">
						<input type="checkbox" class="js-add-to-related" checked="">
						<i></i>
					</label>
				</span>
				<span class="pull-left"><i class="fa fa-file-text text-muted fa m-r-sm"></i></span>
				<div class="clear">
					<a href="{{ action('\Packages\PackageLecturersController@getEdit', $lecturer_related) }}">{{ $lecturer_related->title }}</a>
				</div>
				<input type="hidden" name="lecturers_id[]" value="{{ $lecturer_related->id }}">
			</li>
		@endforeach
	</ul>
</div>
