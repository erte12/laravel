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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store']]);

Route::get('/search', 'SearchController@users');

Route::get('/user-avatar/{id}/{size}', 'ImageController@user_avatar');

Route::get('/users/{user_id}/friends', 'FriendsController@index')->name('friends.index');

Route::post('/friends/{friend}', 'FriendsController@add')->name('friends.add');
Route::patch('/friends/{friend}', 'FriendsController@accept')->name('friends.accept');
Route::delete('/friends/{friend}', 'FriendsController@delete')->name('friends.delete');

Route::resource('/posts', 'PostsController', ['except' => ['index', 'create']]);

Route::get('/wall', 'WallsController@index')->name('wall');

Route::resource('/comments', 'CommentsController', ['except' => ['index', 'create', 'show']]);