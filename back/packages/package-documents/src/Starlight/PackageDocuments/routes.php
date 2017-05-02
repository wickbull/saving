<?php

Route::model('document', 'Packages\Document');

Route::get('/documents/', 'Packages\PackageDocumentsController@getList');

Route::get('/documents/add/', 'Packages\PackageDocumentsController@getAdd');
Route::post('/documents/add/', 'Packages\PackageDocumentsController@postAdd');

Route::get('/documents/edit/{document}', 'Packages\PackageDocumentsController@getEdit');
Route::post('/documents/edit/{document}', 'Packages\PackageDocumentsController@postEdit');

Route::delete('/documents/dalete/{document}', 'Packages\PackageDocumentsController@deleteDelete');
