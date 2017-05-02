<div class="form-group">
	<label for="publish_at" class="control-label">{{_('Related news:')}}</label>

	<div class="js-nothing-in-related @if ($related_news && $related_news->count()) hide @endif" >
		<p class="text-muted">{{_('Nothing to show')}}</p>
	</div>

	<ul class="list-group list-group-lg list-group-sp js-news-related-form-list">
		@foreach ($related_news as $related_news_item)
			<li class="list-group-item" data-id="{{ $related_news_item->id }}">
				<span class="pull-right">
					<label class="i-switch i-switch-md bg-success">
						<input type="checkbox" class="js-add-to-related" checked="">
						<i></i>
					</label>
				</span>
				<span class="pull-left"><i class="fa fa-file-text text-muted fa m-r-sm"></i></span>
				<div class="clear">
					<a href="{{ action('\Packages\PackageNewsController@getEdit', $related_news_item) }}">{{ $related_news_item->title }}</a>
				</div>
				<input type="hidden" name="news_related_id[]" value="{{ $related_news_item->id }}">
			</li>
		@endforeach
	</ul>
</div>
