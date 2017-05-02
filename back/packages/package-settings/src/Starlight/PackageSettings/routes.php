<?php

Route::model('setting', '\Packages\Setting');

Route::get('/settings/', 'Packages\PackageSettingsController@getList');

Route::get('/settings/add', 'Packages\PackageSettingsController@getAdd');
Route::post('/settings/add', 'Packages\PackageSettingsController@postAdd');

Route::get('/settings/edit/{setting}', 'Packages\PackageSettingsController@getEdit');
Route::post('/settings/edit/{setting}', 'Packages\PackageSettingsController@postEdit');
