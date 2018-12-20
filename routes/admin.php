<?php


Route::post('login',    'Admin\AuthController@login');
Route::post('logout',   'Admin\AuthController@logout');
Route::post('refresh',  'Admin\AuthController@refresh');


Route::middleware('admin')->group(function(){
    Route::get('/user',                 'Admin\AuthController@me');

    Route::get('/user/json',            'Admin\UserController@index');
    Route::patch('/user/{id}/status',   'Admin\UserController@changeStatus');

    Route::get('/account',              'Admin\AdminController@index');
    Route::post('/account',             'Admin\AdminController@store');
    Route::patch('/account/{id}',       'Admin\AdminController@update');
    Route::patch('/account/{id}/status',       'Admin\AdminController@changeStatus');

    Route::get('/system',               'Admin\SystemController@index');
    Route::get('/system/active',        'Admin\SystemController@systemsActive');
    Route::post('/system',              'Admin\SystemController@store');
    Route::patch('/system/{id}',        'Admin\SystemController@update');
    Route::delete('/system/{id}',       'Admin\SystemController@delete');

    Route::get('/group',                'Admin\GroupController@index');
    Route::post('/group',               'Admin\GroupController@store');
    Route::patch('/group/{id}',         'Admin\GroupController@update');
    Route::patch('/group/{id}/status',  'Admin\GroupController@changeStatus');
    Route::delete('/group/{id}',        'Admin\GroupController@delete');
});


Route::get('/', function() {
    return view('layouts.admin');
});

Route::get('/{path}', function() {
    return view('layouts.admin');
})->where('path', '(.*)');
