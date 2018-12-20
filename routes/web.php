<?php



Route::get('{path}', function() {
    return view('layouts.main');
})->where('path', '(.*)');




// Route::middleware('guest')->get('/', function () {
//     return view('welcome');
// });
//
// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
//
// Route::get('/users', 'Web\Maintenance\UserController@getusers');
//
// Route::prefix('messages')->group(function () {
//     Route::get('/', ['as' => 'messages', 'uses' => 'Web\MessagesController@index']);
//     Route::get('create', ['as' => 'messages.create', 'uses' => 'Web\MessagesController@create']);
//     Route::post('/', ['as' => 'messages.store', 'uses' => 'Web\MessagesController@store']);
//     Route::get('{id}', ['as' => 'messages.show', 'uses' => 'Web\MessagesController@show']);
//     Route::put('{id}', ['as' => 'messages.update', 'uses' => 'Web\MessagesController@update']);
// });
//
// Route::prefix('message')->group(function(){
//     Route::get('/', 'Web\Messaging\ThreadController@index');
//     Route::get('/{id}', 'Web\Messaging\ThreadController@show');
//
//
//     Route::post('/{id}', 'Web\Messaging\MessageController@store');
// });
//
//
//
// Route::prefix('conversations')->middleware('auth')->group(function(){
//     Route::get('/', 'Web\Musonza\ConversationController@index');
//     Route::get('/{id}', 'Web\Musonza\ConversationController@show');
//     Route::patch('/{id}', 'Web\Musonza\ConversationController@update');
//
//     Route::post('/', 'Web\Musonza\ConversationController@store');
//     Route::post('/{id}/adduser', 'Web\Musonza\ConversationController@addParticipants');
//     Route::post('/{id}/send', 'Web\Musonza\ConversationController@sendMessage');
//     Route::post('/{id}/sendfile', 'Web\Musonza\ConversationController@sendFile');
//     // Route::post('/{id}', 'Web\Messaging\MessageController@store');
//
//
//     Route::get('/{id}/messages', 'Web\Musonza\ConversationController@getMessages');
// });
