<?php

Route::model('fragment', '\Packages\Fragment');

Route::get('/fragments/', 'Packages\PackageFragmentsController@getList');

Route::get('/fragments/add/', 'Packages\PackageFragmentsController@getAdd');
Route::post('/fragments/add/', 'Packages\PackageFragmentsController@postAdd');

Route::get('/fragments/edit/{fragment}/', 'Packages\PackageFragmentsController@getEdit');
Route::post('/fragments/edit/{fragment}/', 'Packages\PackageFragmentsController@postEdit');

Route::delete('/fragments/delete/{fragment}/', 'Packages\PackageFragmentsController@deleteDelete');

Route::get('/fragments/check-slug/', 'Packages\PackageFragmentsController@getCheckSlug');
