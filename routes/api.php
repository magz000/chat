<?php

// Route::post('login', function(){
//     return 'test';
// });

Route::post('login',    'Api\AuthController@login');
Route::post('login/dcp', 'Api\AuthController@loginWithDcp');

Route::post('refresh',  'Api\AuthController@refresh');


Route::post('user', 'Api\Maintenance\UserController@store');
Route::patch('user/{id}', 'Api\Maintenance\UserController@update');


Route::middleware('jwt.auth')->group(function() {

    Route::post('logout',       'Api\AuthController@logout');
    Route::get('user',          'Api\AuthController@me');

    Route::get('user/unread',   'Api\MessageController@getUnreadCount');
    Route::get('users',         'Api\Maintenance\UserController@getusers');

    Route::patch('markall',       'Api\Maintenance\UserController@markAllAsRead');

    Route::prefix('conversation')->group(function() {
        Route::get('/',                 'Api\ConversationController@index');
        Route::post('/',                'Api\ConversationController@store');
        Route::patch('/{id}',           'Api\ConversationController@update');
        Route::post('/{id}/read',       'Api\ConversationController@markAsRead');
        Route::post('/{id}/add',        'Api\ConversationController@addParticipants');

        Route::get('/{id}/messages',    'Api\MessageController@getMessages');
        // Route::post('/{id}/send', 'Api\MessageController@sendMessages');
        Route::post('/send',            'Api\MessageController@sendMessages');
    });
});


Route::middleware('cors')->options('{any?}', function (){
    return response('',200);
})->where('any', '.*');
