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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SuperbViewController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('superb_views', SuperbViewController::class)->only(['index', 'create', 'store', 'show'])->middleware('auth');

// Route::controller(SuperbViewController::class)->group(function () {
//     Route::get('/superb_views/prefecture/{prefecture_id}', 'index')->name('superb_views.index');
//     Route::get('/superb_views/create', 'create')->name('superb_views.create');
//     Route::post('/superb_views', 'store')->name('superb_views.store');
//     Route::get('/superb_views/{superb_view}', 'show')->name('superb_views.show');
// })->middleware('auth');
