<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::get('/singer/form', [\App\Http\Controllers\SingerOrderController::class, 'index'])->name('singer-form.index');

Route::group(['prefix' => '/admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/songs', [\App\Http\Controllers\Admin\SongController::class, 'index'])->name('admin.song.index');
});
