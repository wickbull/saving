<thead>
	<tr>
		<th class="footable-visible footable-first-column">
			{{ _('Title') }}
		</th>
		</th>
		<th class="footable-visible">
			{{ _('Status') }}
		</th>
		<th class="footable-visible footable-last-column">
			{{ _('Edit') }}
		</th>
	</tr>
</thead>

<tbody>
	@foreach($lecturers as $lecturer)
		<tr>
			<td class="footable-first-column">
				<span class="footable-toggle"></span> <a href="{{ $lecturer->getViewUrl() }}">{{ $lecturer->title }}</a>
			</td>

			<td class="footable-visible">
				@if ($lecturer->is_active)
					<span class="label bg-success" title="Active">{{ _('Active') }}</span>
				@else
					<span class="label bg-danger" title="Disabled">{{ _('Disabled') }}</span>
				@endif
			</td>

			<td class="footable-visible footable-last-column">
				<a href="{{ action('\Packages\PackageLecturersController@getEdit', [$lecturer, 'lang' => \Input::get('lang') ?: 'uk']) }}">{{ _('Edit') }}</a>
			</td>

		</tr>

	@endforeach
</tbody>
<tfoot>
	<tr>
		<td colspan="8" class="text-center footable-visible">

			<div class="text-center">
				{!! $lecturers->appends(['q' => \Input::get('q'), 'lang' => \Input::get('lang')])->render() !!}
			</div>

			@if (! $lecturers->count())
				<p class="text-muted">
					{{ _('There is no available lecturers by this request') }}
				</p>
			@endif
		</td>
	</tr>
</tfoot>
