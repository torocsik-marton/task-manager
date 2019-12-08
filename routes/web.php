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

Route::get('/', 'Auth\LoginController@loginView')
    ->name('login');

Route::post('/', 'Auth\LoginController@login');

Route::get('/task-manager', 'Auth\TaskManagerController@taskManagerView')
    ->name('task-manager');
