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

Route::get('/logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::post('/', 'Auth\LoginController@login');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/task-manager', 'TaskManagerController@taskManagerView')
        ->name('task-manager');

    Route::post('/task-manager/task', 'TaskManagerController@addTask')
        ->name('task-manager.add');

    Route::any('/task-manager/task/{id}/complete', 'TaskManagerController@completeTask')
        ->name('task-manager.complete');
});
