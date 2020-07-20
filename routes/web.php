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

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;
use App\Post;

Auth::routes();

Route::get('/', 'PostsController@index');

Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
Route::get('account', 'UsersController@account')->name('account');
Route::get('softdelete', 'UsersController@softdelete')->name('softdelete');

Route::resource('posts', 'PostsController',['only' => ['index', 'create', 'store', 'show', 'destroy']])->middleware('auth');

Route::post('/users/{id}/follow', 'UserFollowController@store')->name('user.follow');
Route::delete('/users/{id}/unfollow', 'UserFollowController@destroy')->name('user.unfollow');
Route::get('/users/{id}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');

Route::get('/users/{id}/likes', 'UsersController@likes')->name('users.likes');

Route::get('/home', 'HomeController@index')->name('home');
