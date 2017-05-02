<thead>
	<tr>
		<th class="footable-visible footable-first-column">
			{{ _('Title') }}
		</th>
		<th class="footable-hidden">
			{{ _('Create Time') }}
		</th>
		<th class="footable-hidden">
			{{ _('Update Time') }}
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
				<span class="footable-toggle"></span> <a href="{{ action('\Packages\PackageLecturersController@getEdit', $lecturer) }}">{{ $lecturer->title }}</a>
			</td>

			<td class="footable-hidden">{{ $lecturer->created_at->format('d.m.Y H:i') }}</td>
			<td class="footable-hidden">{{ $lecturer->updated_at->format('d.m.Y H:i') }}</td>

			<td class="footable-visible">
				@if ($lecturer->is_active)
					<span class="label bg-success" title="Active">{{ _('Active') }}</span>
				@else
					<span class="label bg-danger" title="Disabled">{{ _('Disabled') }}</span>
				@endif
			</td>

			<td class="footable-visible footable-last-column">
				<a href="{{ action('\Packages\PackageLecturersController@getEdit', $lecturer) }}">{{ _('Edit') }}</a>
			</td>

		</tr>

	@endforeach
</tbody>
<tfoot>
	<tr>
		<td colspan="8" class="text-center footable-visible">

			<div class="js-pagination" data-target=".js-lecturers-materials-container">
				{!! $lecturers->render() !!}
			</div>

			@if (! $lecturers->count())
				<p class="text-muted">
					{{ _('There is no available lecturers by this request') }}
				</p>
			@endif
		</td>
	</tr>
</tfoot>
