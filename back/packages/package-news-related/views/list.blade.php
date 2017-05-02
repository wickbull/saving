@if (! $news->count())
	<div class="text-center text-muted">
		{{_('There is no available news')}}
	</div>
@endif

<ul class="list-group list-group-lg list-group-sp">

	@foreach ($news as $news_item)
		<li class="list-group-item" data-id="{{ $news_item->id }}">
			<span class="pull-right">
				<label class="i-switch i-switch-md bg-success">
					<input type="checkbox" class="js-add-to-related">
					<i></i>
				</label>
			</span>
			<span class="pull-left"><i class="fa fa-file-text text-muted fa m-r-sm"></i></span>
			<div class="clear">
				<a href="{{ $news_item->getViewUrl() }}" target="_blank">{{ $news_item->title }}</a>
			</div>
			<input type="hidden" name="news_related_id[]" value="{{ $news_item->id }}">
		</li>
	@endforeach

	<div class="js-pagination" data-target=".js-related-news-container" @if (! empty($query)) data-q="{{ $query }}" @endif>
		{!! $news->render() !!}
	</div>

</ul>
