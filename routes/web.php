<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SweetheartController;

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

Route::get('/', [SweetheartController::class, 'home'])->name('home');
Route::get('/gallery', [SweetheartController::class, 'gallery'])->name('gallery');
Route::get('/moments', [SweetheartController::class, 'moments'])->name('moments');
Route::get('/letter', [SweetheartController::class, 'letter'])->name('letter');
