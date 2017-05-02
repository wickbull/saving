<?php

Route::model('user', '\Packages\User');

Route::get('/users/', 'Packages\PackageUsersController@getList');

Route::get('/users/sort/', 'Packages\PackageUsersController@getSortList');

Route::get('/users/add/', 'Packages\PackageUsersController@getAdd');
Route::post('/users/add/', 'Packages\PackageUsersController@postAdd');

Route::get('/users/edit/{user}/', ['as' => 'usersEdit', 'uses' => 'Packages\PackageUsersController@getEdit']);
Route::post('/users/edit/{user}/', 'Packages\PackageUsersController@postEdit');

Route::get('/users/materials/{user}/', ['as' => 'usersMaterials', 'uses' => 'Packages\PackageUsersController@getMaterials']);

Route::post('/users/password/send-reset/{user}/', 'Packages\PackageUsersController@postSendResetPasswordAction');

Route::get('/users/password/reset/{token}/', 'Packages\PackageUsersController@getResetPasswordAction');
Route::post('/users/password/reset/{token}/', 'Packages\PackageUsersController@postResetPasswordAction');

Route::post('/users/invite/{user}/', 'Packages\PackageUsersController@postSendInviteAction');
Route::get('/users/invite/{token}/', 'Packages\PackageUsersController@getInviteAction');

Route::delete('/users/delete/{user}/', ['as' => 'usersDelete', 'uses' => 'Packages\PackageUsersController@deleteDelete']);
