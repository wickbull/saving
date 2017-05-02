<?php

Route::model('tag', '\Packages\Tag');

Route::get('/tags/', 'Packages\PackageTagsController@getList');

Route::get('/tags/', 'Packages\PackageTagsController@getList');

Route::get('/tags/add/', 'Packages\PackageTagsController@getAdd');
Route::post('/tags/add/', 'Packages\PackageTagsController@postAdd');

Route::get('/tags/edit/{tag}', 'Packages\PackageTagsController@getEdit');
Route::post('/tags/edit/{tag}', 'Packages\PackageTagsController@postEdit');

Route::delete('/tags/delete/{tag}/', 'Packages\PackageTagsController@deleteDelete');
