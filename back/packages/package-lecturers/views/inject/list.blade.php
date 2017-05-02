@if (! $lecturers->count())
	<div class="text-center text-muted">
		{{_('There is no available lecturers')}}
	</div>
@endif

<ul class="list-group list-group-lg list-group-sp">

	@foreach ($lecturers as $lecturer)
		<li class="list-group-item" data-id="{{ $lecturer->id }}">
			<span class="pull-right">
				<label class="i-switch i-switch-md bg-success">
					<input type="checkbox" class="js-add-to-related">
					<i></i>
				</label>
			</span>
			<span class="pull-left"><i class="fa fa-file-text text-muted fa m-r-sm"></i></span>
			<div class="clear">
				<a href="{{ $lecturer->getViewUrl() }}" target="_blank">{{ $lecturer->title }}</a>
			</div>
			<input type="hidden" name="lecturers_id[]" value="{{ $lecturer->id }}">
		</li>
	@endforeach

	<div class="js-pagination" data-target=".js-lecturers-container" @if (! empty($query)) data-q="{{ $query }}" @endif>
		{!! $lecturers->render() !!}
	</div>

</ul>
