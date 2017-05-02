<?php

Route::model('lecturer', '\Packages\Lecturer');

Route::get('lecturers/', 'Packages\PackageLecturersController@getList');

Route::get('lecturers/sidebar/list', 'Packages\PackageLecturersController@getListForSidebar');

Route::get('lecturers/add/', 'Packages\PackageLecturersController@getAdd');
Route::post('lecturers/add/', 'Packages\PackageLecturersController@postAdd');

Route::get('lecturers/edit/{lecturer}/', 'Packages\PackageLecturersController@getEdit');
Route::post('lecturers/edit/{lecturer}/', 'Packages\PackageLecturersController@postEdit');

Route::get('/lecturers/users/{user}/', 'Packages\PackageLecturersController@getLecturersByUser');

Route::delete('lecturers/delete/{lecturer}/', 'Packages\PackageLecturersController@deleteDelete');

Route::get('lecturers/check-slug/', 'Packages\PackageLecturersController@getCheckSlug');

Route::get('lecturers/search/', 'Packages\PackageLecturersController@getSearch');
