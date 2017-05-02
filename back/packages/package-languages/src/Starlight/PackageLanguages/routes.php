<?php

Route::model('language', '\Packages\Language');

Route::get('/languages/', 'Packages\PackageLanguagesController@getList');

Route::get('/languages/add', 'Packages\PackageLanguagesController@getAdd');
Route::post('/languages/add', 'Packages\PackageLanguagesController@postAdd');

Route::get('/languages/edit/{language}', 'Packages\PackageLanguagesController@getEdit');
Route::post('/languages/edit/{language}', 'Packages\PackageLanguagesController@postEdit');
