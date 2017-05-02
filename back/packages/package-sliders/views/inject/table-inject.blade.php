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
    @foreach($articles as $article)
        <tr>
            <td class="footable-first-column">
                <span class="footable-toggle"></span> <a href="{{ action('\Packages\PackageArticlesController@getEdit', $article) }}">{{ $article->title }}</a>
            </td>

            <td class="footable-visible">{{ $article->publish_at->format('d.m.Y H:i') }}</td>
            <td class="footable-hidden">{{ $article->created_at->format('d.m.Y H:i') }}</td>
            <td class="footable-hidden">{{ $article->updated_at->format('d.m.Y H:i') }}</td>

            <td class="footable-hidden"> <a href="{{ action('\Packages\PackageUsersController@getEdit', $article->creator) }}">{{ $article->creator->first_name }} {{ $article->creator->last_name }}</a> </td>

            <td class="footable-hidden"> <a href="{{ action('\Packages\PackageUsersController@getEdit', $article->editor) }}">{{ $article->editor->first_name }} {{ $article->editor->last_name }}</a> </td>


            <td class="footable-visible">
                @if ($article->is_active)
                    <span class="label bg-success" title="Active">{{ _('Active') }}</span>
                @else
                    <span class="label bg-danger" title="Disabled">{{ _('Disabled') }}</span>
                @endif
            </td>

            <td class="footable-visible footable-last-column">
                <a href="{{ action('\Packages\PackageArticlesController@getEdit', $article) }}">{{ _('Edit') }}</a>
            </td>

        </tr>

    @endforeach
</tbody>
<tfoot>
    <tr>
        <td colspan="8" class="text-center footable-visible">

            <div class="js-pagination" data-target=".js-articles-materials-container">
                {!! $articles->render() !!}
            </div>

            @if (! $articles->count())
                <p class="text-muted">
                    {{ _('There is no available articles by this request') }}
                </p>
            @endif
        </td>
    </tr>
</tfoot>
