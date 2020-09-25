<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/', "Controller@index")->name("index");
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about-us', 'AboutUs\AboutUsController@index')->name('about');
Route::get('todos/completed', 'Todos\TodoController@completed')->name('todos.done');
Route::get('todos/not-completed', 'Todos\TodoController@notCompleted')->name('todos.undone');
Route::put('todos/make-completed/{todo}', 'Todos\TodoController@makeCompleted')->name('todos.makeDone');
Route::put('todos/make-not-completed/{todo}', 'Todos\TodoController@makeNotCompleted')->name('todos.makeUndone');
Route::get('todos/{todo}/affected-to/{user}', 'Todos\TodoController@affectedTo')->name('todos.affectedTo');
Route::resource('todos', 'Todos\TodoController');
