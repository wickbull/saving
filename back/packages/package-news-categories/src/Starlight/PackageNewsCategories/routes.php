<?php

Route::model('news_category', '\Packages\NewsCategory');

Route::get('/news/categories/', 'Packages\PackageNewsCategoriesController@getList');

Route::get('/news/categories/add/', 'Packages\PackageNewsCategoriesController@getAdd');
Route::post('/news/categories/add/', 'Packages\PackageNewsCategoriesController@postAdd');

Route::get('/news/categories/edit/{news_category}', 'Packages\PackageNewsCategoriesController@getEdit');
Route::post('/news/categories/edit/{news_category}', 'Packages\PackageNewsCategoriesController@postEdit');

Route::delete('/news/categories/delete/{news_category}', 'Packages\PackageNewsCategoriesController@deleteDelete');

Route::get('/news/categories/check-slug/', 'Packages\PackageNewsCategoriesController@getCheckSlug');
