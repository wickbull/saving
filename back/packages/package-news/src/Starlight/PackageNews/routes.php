<?php

Route::model('news', '\Packages\News');

Route::get('/news/', 'Packages\PackageNewsController@getList');

Route::get('/news/add/', 'Packages\PackageNewsController@getAdd');
Route::post('/news/add/', 'Packages\PackageNewsController@postAdd');

Route::get('/news/edit/{news}/', 'Packages\PackageNewsController@getEdit');
Route::post('/news/edit/{news}/', 'Packages\PackageNewsController@postEdit');

Route::delete('/news/delete/{news}/', 'Packages\PackageNewsController@deleteDelete');

Route::get('/news/users/{user}/', 'Packages\PackageNewsController@getNewsByUser');

Route::get('/news/check-slug/', 'Packages\PackageNewsController@getCheckSlug');
