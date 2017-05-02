<div class="tab-pane js-related-selector" id="sidebar-news-related" data-require="related" data-url="{{ action('\Packages\PackageNewsRelatedController@getList') }}" data-form-target=".js-news-related-form-list" data-container=".js-related-news-container" data-tab=".js-related-news-tab">
	<div class="wrapper-md">

		<form action="{{ action('\Packages\PackageNewsRelatedController@getSearch') }}" class="js-related-search-form" method="GET">
			<div class="form-group">
				<div class="input-group">
						<input type="text" ng-model="selected" class="form-control input-sm bg-light no-border rounded padder" placeholder="{{ _('Search news') }}" name="q">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
						</span>
				</div>
			</div>
		</form>

		<div class="js-related-news-container" @if (\Route::current()->getParameter('news')) data-id="{{ \Route::current()->getParameter('news')->id }}" @endif ></div>
	</div>
</div>
