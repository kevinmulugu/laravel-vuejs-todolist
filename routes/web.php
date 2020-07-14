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
// The root uri of application
Route::get('/', 'TodoItemController@index')->name('showTodosPage');
Route::get('/todos', 'TodoItemController@todos')->name('loadTodos');
Route::post('/todos', 'TodoItemController@store')->name('storeTodos');
Route::put('/todos/{todoItem}', 'TodoItemController@update')->name('updateTodo');
Route::delete('/todos/{todoItem}', 'TodoItemController@destroy')->name('deleteTodo');
