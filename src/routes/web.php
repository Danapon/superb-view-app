<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperbViewController;

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

Route::get('/', [SuperbViewController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(SuperbViewController::class)->group(function () {
    Route::get('superb_views', 'index')->name('superb_views.index');
    Route::get('superb_views/create', 'create')->name('superb_views.create');
    Route::post('superb_views', 'store')->name('superb_views.store');
    Route::get('superb_views/{superb_view}', 'show')->name('superb_views.show');
    Route::delete('superb_views/{superb_view}/{id}', 'destroy')->name('superb_views.destroy');
})->middleware('auth');

Route::delete('/users/{user}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');