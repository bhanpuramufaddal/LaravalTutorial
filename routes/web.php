<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TaskController::class)
    ->prefix('tasks/{task}')
    ->as('tasks.')
    ->group(function () {
        Route::patch('complete', 'complete')->name('complete');
        Route::patch('yet_complete', 'yetComplete')->name('yet_complete');
    });

Route::resource('tasks', TaskController::class);