<thead>
	<tr>
		<th class="footable-visible footable-first-column">
			{{ _('Title') }}
		</th>
		<th class="footable-visible">
			{{ _('Publish Time') }}
		</th>
		<th class="footable-hidden">
			{{ _('Create Time') }}
		</th>
		<th class="footable-hidden">
			{{ _('Update Time') }}
		</th>
		<th class="footable-hidden">
			{{ _('Creator') }}
		</th>
		<th class="footable-hidden">
			{{ _('Editor') }}
		</th>
		<th class="footable-hidden">
			{{ _('Status') }}
		</th>
		<th class="footable-visible footable-last-column">
			{{ _('Edit') }}
		</th>
	</tr>
</thead>

<tbody>
	@foreach($news as $item)
		<tr>
			<td class="footable-first-column">
				<span class="footable-toggle"></span> <a href="{{ action('\Packages\PackageNewsController@getEdit', $item) }}" >{{ $item->title }}</a>
			</td>

			<td class="footable-visible">{{ $item->publish_at->format('d.m.Y H:i') }}</td>
			<td class="footable-hidden">{{ $item->created_at->format('d.m.Y H:i') }}</td>
			<td class="footable-hidden">{{ $item->updated_at->format('d.m.Y H:i') }}</td>

			<td class="footable-hidden"> <a href="{{ $item->creator->getViewUrlInListOfAnotherPackages() }}">{{ $item->creator->first_name }} {{ $item->creator->last_name }}</a> </td>

			<td class="footable-hidden"> <a href="{{ $item->editor->getViewUrlInListOfAnotherPackages() }}">{{ $item->editor->first_name }} {{ $item->editor->last_name }}</a> </td>

			<td class="footable-visible">
				@if ($item->is_active)
					<span class="label bg-success" title="Active">{{ _('Active') }}</span>
				@else
					<span class="label bg-danger" title="Disabled">{{ _('Disabled') }}</span>
				@endif
			</td>

			<td class="footable-visible footable-last-column">
				<a href="{{ action('\Packages\PackageNewsController@getEdit', [$item, 'lang' => \Input::get('lang') ?: 'uk']) }}">{{ _('Edit') }}</a>
			</td>

		</tr>

	@endforeach
</tbody>
<tfoot>
	<tr>
		<td colspan="8" class="text-center footable-visible">

			<div class="text-center">
				{!! $news->appends(['q' => \Input::get('q'), 'lang' => \Input::get('lang')])->render() !!}
			</div>

			@if (! $news->count())
				<p class="text-muted">
					{{ _('There is no available news by this request') }}
				</p>
			@endif
		</td>
	</tr>
</tfoot>
