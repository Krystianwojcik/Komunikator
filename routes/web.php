<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ChatController@index');
Route::get('/messages/{id}/', 'ChatController@fetchAllMessages');
Route::post('/messages', 'ChatController@sendMessage');

Route::get('/gruops', 'GroupsController@fetchGroup');

Route::get('/gruops-check/{id}/', 'GroupsController@checkGroup');

Route::get('/friends', 'FriendsController@fetchFriend');

Route::get('/add-friends/{email}/', 'FriendsController@addFriend');



Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear ');
    Artisan::call('view:clear ');
    return "Cache is cleared";
});