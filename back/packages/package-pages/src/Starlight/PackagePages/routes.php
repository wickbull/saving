<?php

Route::model('page', '\Packages\Page');

Route::get('/pages/', 'Packages\PackagePagesController@getList');

Route::get('/pages/add/', 'Packages\PackagePagesController@getAdd');
Route::post('/pages/add/', 'Packages\PackagePagesController@postAdd');

Route::get('/pages/edit/{page}/', 'Packages\PackagePagesController@getEdit');
Route::post('/pages/edit/{page}/', 'Packages\PackagePagesController@postEdit');

Route::delete('/pages/delete/{page}/', 'Packages\PackagePagesController@deleteDelete');

Route::get('/pages/check-slug/', 'Packages\PackagePagesController@getCheckSlug');
