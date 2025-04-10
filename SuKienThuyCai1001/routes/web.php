<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
// use App\Http\Controllers\Event\SuKienController;
use App\Http\Controllers\SuKienController;
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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/Sukien', [SuKienController::class, 'index']);
Route::get('/Sukien', [SuKienController::class, 'index'])->name('trangchu.show');
Route::get('/Tintuc', [SuKienController::class, 'Blog'])->name('tintuc.show');
