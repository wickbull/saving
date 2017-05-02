<thead>
					
	<tr>
		@foreach([
					'First Name' => ['first_name', 'asc'],
					'Last Name' => ['last_name', 'asc'], 
					'E-mail' => ['email', 'asc'], 
					'Update Time' => ['updated_at', 'desc'], 
					'Time Add' => ['created_at', 'desc']
					
					] as $key => $value)

			<th class="footable-visible">

				@if(Input::get('by') == $value[0])

					@if(Input::get('order') == 'asc')
						<a href="{{ URL::alter([], ['by' => $value[0], 'order' => 'desc']) }}"> {{ _($key) }}

							@if(Input::get('by') == $value[0]) <span class="glyphicon glyphicon-sort-by-attributes"></span> @endif
						</a>

					@else

						<a href="{{ URL::alter([], ['by' => $value[0], 'order' => 'asc']) }}"> {{ _($key) }}

							@if(Input::get('by') == $value[0]) <span class="glyphicon glyphicon-sort-by-attributes-alt"></span> @endif
						</a>
					
					@endif

				@else
					<a href="{{ URL::alter([], ['by' => $value[0], 'order' => $value[1]]) }}"> {{ _($key) }}

						@if(Input::get('by') == $value[0]) <span class="glyphicon glyphicon-sort-by-attributes-alt"></span> @endif
					</a>

				@endif

			</th>

		@endforeach
		
		<th class="footable-hidden">
			{{ _('Edit') }}
		</th>

	</tr>
</thead>

<tbody>
	@foreach($users as $user)
		<tr>
			<td class="footable-first-column">
				<span class="footable-toggle"></span> {{ $user->first_name }}
			</td>
			
			<td class="footable-first-column">
				<span class="footable-toggle"></span> {{ $user->last_name }}
			</td>
			
			<td class="footable-first-column">
				<span class="footable-toggle"></span> {{ $user->email }}
			</td>

			<td class="footable-hidden">{{ $user->updated_at->format('d.m.Y H:i') }}</td>

			<td class="footable-visible">{{ $user->created_at->format('d.m.Y H:i') }}</td>

			<td class="footable-first-column">
				<span class="footable-toggle"></span> <a href="{{ action('\Packages\PackageUsersController@getEdit', $user) }}"> {{ _('Edit') }} </a>
			</td>

		</tr>

	@endforeach
</tbody>
