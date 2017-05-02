<div class="tab-pane js-related-selector" id="sidebar-lecturers" data-require="related" data-url="{{ action('\Packages\PackageLecturersController@getListForSidebar') }}" data-container=".js-lecturers-container" data-tab=".js-lecturers-tab" data-form-target=".js-lecturers-form-list">
	<div class="wrapper-md">
		<form action="{{ action('\Packages\PackageLecturersController@getSearch') }}" class="js-related-search-form" method="GET">
			<div class="form-group">
				<div class="input-group">
					<input type="text" ng-model="selected" class="form-control input-sm bg-light no-border rounded padder" placeholder="{{ _('Search lecturers') }}" name="q">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</div>
		</form>

		<div class="js-lecturers-container" @if (\Route::current()->getParameter('lecturer')) data-id="{{ \Route::current()->getParameter('lecturer')->id }}" @endif ></div>
	</div>
</div>
