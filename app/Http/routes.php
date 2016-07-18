<?php

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('login', 'UsersController@index');
Route::post('post-register', 'UsersController@postRegister');
Route::post('post-login', 'UsersController@postLogin');

//ADMIN
Route::get('admin', 'backend\AdminController@index');

Route::get('admin/user', 'backend\AdminUserController@index');
Route::get('admin/user/create', 'backend\AdminUserController@create');
Route::post('admin/user/store', 'backend\AdminUserController@store');
Route::get('admin/user/show/{id}', 'backend\AdminUserController@show');
Route::get('admin/user/edit/{id}', 'backend\AdminUserController@edit');
Route::post('admin/user/update/{id}', 'backend\AdminUserController@update');
Route::post('admin/user/delete/{id}', 'backend\AdminUserController@delete');

// Admin Product
Route::get('admin/product', 'backend\AdminProductController@index');
Route::get('admin/product/create', 'backend\AdminProductController@create');
Route::post('admin/product/store', 'backend\AdminProductController@store');
Route::get('admin/product/show/{id}', 'backend\AdminProductController@show');
Route::get('admin/product/edit/{id}', 'backend\AdminProductController@edit');
Route::post('admin/product/update/{id}', 'backend\AdminProductController@update');
Route::post('admin/product/delete/{id}', 'backend\AdminProductController@delete');

// Admin Product Category
Route::get('admin/product/category', 'backend\AdminProductCategoryController@index');
Route::get('admin/product/category/create', 'backend\AdminProductCategoryController@create');
Route::post('admin/product/category/store', 'backend\AdminProductCategoryController@store');
Route::get('admin/product/category/show/{id}', 'backend\AdminProductCategoryController@show');
Route::get('admin/product/category/edit/{id}', 'backend\AdminProductCategoryController@edit');
Route::post('admin/product/category/update/{id}', 'backend\AdminProductCategoryController@update');
Route::post('admin/product/category/delete/{id}', 'backend\AdminProductCategoryController@delete');

// Admin Product Brand
Route::get('admin/product/brand', 'backend\AdminProductBrandController@index');
Route::get('admin/product/brand/create', 'backend\AdminProductBrandController@create');
Route::post('admin/product/brand/store', 'backend\AdminProductBrandController@store');
Route::get('admin/product/brand/show/{id}', 'backend\AdminProductBrandController@show');
Route::get('admin/product/brand/edit/{id}', 'backend\AdminProductBrandController@edit');
Route::post('admin/product/brand/update/{id}', 'backend\AdminProductBrandController@update');
Route::post('admin/product/brand/delete/{id}', 'backend\AdminProductBrandController@delete');