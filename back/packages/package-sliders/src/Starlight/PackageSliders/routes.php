<?php

Route::model('slider', '\Packages\Slider');

Route::get('/sliders/', 'Packages\PackageSlidersController@getList');

Route::get('/sliders/add/', 'Packages\PackageSlidersController@getAdd');
Route::post('/sliders/add/', 'Packages\PackageSlidersController@postAdd');

Route::get('/sliders/edit/{slider}/', 'Packages\PackageSlidersController@getEdit');
Route::post('/sliders/edit/{slider}/', 'Packages\PackageSlidersController@postEdit');

Route::delete('/sliders/delete/{slider}/', 'Packages\PackageSlidersController@deleteDelete');

Route::get('/sliders/check-slug/', 'Packages\PackageSlidersController@getCheckSlug');

Route::get('/sliders/list/search/', 'Packages\PackageSlidersController@getSearchList');
