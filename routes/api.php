<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me'])->name('api.me');

});

Route::post('/singer/order/create', [\App\Http\Controllers\SingerOrderController::class, 'store'])->name('singer.order.create');

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => '/song'], function () {
        Route::post('/store', [\App\Http\Controllers\Admin\SongController::class, 'store'])->name('admin.song.store');
        Route::post('/store/bulk', [\App\Http\Controllers\Admin\SongController::class, 'bulk_store'])->name('admin.song.store.bulk');
        Route::post('/update/{song}', [\App\Http\Controllers\Admin\SongController::class, 'update'])->name('admin.song.update');
        Route::delete('/destroy/{song}', [\App\Http\Controllers\Admin\SongController::class, 'destroy'])->name('admin.song.destroy');
        Route::delete('/clear', [\App\Http\Controllers\Admin\SongController::class, 'clear'])->name('admin.songs.clear');
    });
    Route::post('phone/store', [\App\Http\Controllers\Admin\WhatsappPhoneController::class, 'store'])->name('admin.phone.store');
});
