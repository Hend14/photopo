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
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

Route::get('users.edit', 'locationsController@list');