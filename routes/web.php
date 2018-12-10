<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
	'domain' => sprintf('admin.%s', config('custom.app.domain'))
], function(){
	Route::group(['namespace' => 'Admin'], function(){

		Route::group(['namespace' => 'Auth'], function(){
			Route::get('login', 'LoginController@show')->name('admin.login.show')->middleware('guest:admin');
			Route::post('login', 'LoginController@login')->name('admin.login.post')->middleware('guest:admin');
			Route::post('logout', 'LoginController@logout')->name('admin.logout.post')->middleware('auth:admin');
			Route::get('register', 'RegisterController@show')->name('admin.register.show')->middleware('guest:admin');
			Route::post('register', 'RegisterController@store')->name('admin.register.post')->middleware('guest:admin');
			Route::post('deny', 'RegisterController@deny')->name('admin.register.deny')->middleware('auth:admin');
		});

		Route::group(['middleware' => 'auth:admin'], function(){
			Route::get('users', 'UserController@index')->name('admin.user.index')->middleware('auth:admin');
			Route::group(['prefix' => 'user'], function(){
				Route::get('create', 'UserController@create')->name('admin.user.create');
				Route::post('store', 'UserController@store')->name('admin.user.store');
				Route::get('{id}/edit', 'UserController@edit')->name('admin.user.edit');
				Route::post('update', 'UserController@update')->name('admin.user.update');
				Route::get('{id}', 'UserController@show')->name('admin.user.show');
			});

            Route::get('clients', 'ClientController@index')->name('admin.client.index')->middleware('auth:admin');
            Route::group(['prefix' => 'client'], function(){
                Route::get('create', 'ClientController@create')->name('admin.client.create');
                Route::post('store', 'ClientController@store')->name('admin.client.store');
                Route::get('{id}/edit', 'ClientController@edit')->name('admin.client.edit');
                Route::post('update', 'ClientController@update')->name('admin.client.update');
                Route::get('{id}', 'ClientController@show')->name('admin.client.show');
            });

            Route::get('templates', 'TemplateController@index')->name('admin.template.index')->middleware('auth:admin');
            Route::group(['prefix' => 'template'], function(){
                Route::get('create', 'TemplateController@create')->name('admin.template.create');
                Route::post('store', 'TemplateController@store')->name('admin.template.store');
                Route::get('{id}/edit', 'TemplateController@edit')->name('admin.template.edit');
                Route::post('update', 'TemplateController@update')->name('admin.template.update');
                Route::get('{id}', 'TemplateController@show')->name('admin.template.show');
            });
		});

		Route::get('/templates', 'UserController@index')->name('admin.template.index')->middleware('auth:admin');
		Route::get('/', 'DashboardController@index')->name('admin.dashboard.index')->middleware('auth:admin');
	});
});

Route::group([
	'domain' => sprintf('{client}.%s', config('custom.app.domain'))
], function(){
	Route::group(['namespace' => 'Client'], function(){
		Route::group(['namespace' => 'Auth'], function(){
			Route::get('login', 'LoginController@show')->name('client.login.show')->middleware('guest:client');
			Route::post('login', 'LoginController@login')->name('client.login.post')->middleware('guest:client');
			Route::post('logout', 'LoginController@logout')->name('client.logout.post')->middleware('auth:client');
			Route::get('register', 'RegisterController@show')->name('client.register.show')->middleware('guest:client');
			Route::post('register', 'RegisterController@create')->name('client.register.post')->middleware('guest:client');
		});
		Route::get('/', 'DashboardController@index')->name('client.dashboard.index')->middleware('auth:client');
	});
});

