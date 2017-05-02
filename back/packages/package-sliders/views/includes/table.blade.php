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
        <th class="footable-hidden">
            {{ _('Status') }}
        </th>
        <th class="footable-visible footable-last-column">
            {{ _('Edit') }}
        </th>
    </tr>
</thead>

<tbody>
    @foreach($sliders as $slider)
        <tr>
            <td class="footable-first-column">
                <span class="footable-toggle"></span>
                <a href="{{ action('\Packages\PackageSlidersController@getEdit', $slider) }}">{{ $slider->title }}</a>
            </td>

            <td class="footable-hidden">{{ $slider->created_at->format('d.m.Y H:i') }}</td>
            <td class="footable-hidden">{{ $slider->updated_at->format('d.m.Y H:i') }}</td>

            <td class="footable-visible">
                @if ($slider->is_active)
                    <span class="label bg-success" title="Active">{{ _('Active') }}</span>
                @else
                    <span class="label bg-danger" title="Disabled">{{ _('Disabled') }}</span>
                @endif
            </td>

            <td class="footable-visible footable-last-column">
                <a href="{{ action('\Packages\PackageSlidersController@getEdit', $slider) }}">{{ _('Edit') }}</a>
            </td>

        </tr>

    @endforeach
</tbody>
<tfoot>
    <tr>
        <td colspan="8" class="text-center footable-visible">

            <div class="text-center">
                {!! $sliders->appends(['q' => \Input::get('q')])->render() !!}
            </div>

        </td>
    </tr>
</tfoot>
