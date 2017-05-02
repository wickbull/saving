<?php

Route::model('status', '\Packages\Status');

Route::get('/statuses/', 'Packages\PackageStatusesController@getList');

Route::get('/statuses/add/', 'Packages\PackageStatusesController@getAdd');
Route::post('/statuses/add/', 'Packages\PackageStatusesController@postAdd');

Route::get('/statuses/edit/{status}', 'Packages\PackageStatusesController@getEdit');
Route::post('/statuses/edit/{status}', 'Packages\PackageStatusesController@postEdit');

Route::get('/statuses/check-slug/', 'Packages\PackageStatusesController@getCheckSlug');
