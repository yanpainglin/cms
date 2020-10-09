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

Route::get('/', 'WelcomeController@index')->name('welcome');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::resource('categories','categoryController');
    Route::resource('tags','TagController');
    Route::resource('posts','PostController')->middleware('auth');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('restore-posts/{post}', 'PostController@restore')->name('restore-posts');
});

//Admin::route();

Route::middleware(['auth', 'admin'])->group(function (){

    Route::get('/user', 'UserController@index')->name('users.index');
    Route::get('/admin/{id}', 'UserController@admin')->name('makeadmin');
    Route::get('/writer/{id}', 'UserController@writer')->name('makewriter');
});
