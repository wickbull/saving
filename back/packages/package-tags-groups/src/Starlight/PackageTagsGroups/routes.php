<?php

Route::model('tags_group', '\Packages\TagsGroup');

Route::get('/tags/groups/', 'Packages\PackageTagsGroupsController@getList');


Route::get('/tags/groups/add/', 'Packages\PackageTagsGroupsController@getAdd');
Route::post('/tags/groups/add/', 'Packages\PackageTagsGroupsController@postAdd');

Route::get('/tags/groups/edit/{tags_group}', 'Packages\PackageTagsGroupsController@getEdit');
Route::post('/tags/groups/edit/{tags_group}', 'Packages\PackageTagsGroupsController@postEdit');

Route::get('/tags/groups/check-slug/', 'Packages\PackageTagsGroupsController@getCheckSlug');
Route::get('/tags/groups/list-tags/', 'Packages\PackageTagsGroupsController@getListTags');
