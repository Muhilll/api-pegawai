<?php

use App\Http\Controllers\AdminLowonganController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('lowongan/get', [AdminLowonganController::class, 'getLowongan']);
Route::get('lowongan/add', [AdminLowonganController::class, 'addLowongan']);
Route::get('lowongan/edit', [AdminLowonganController::class, 'editLowongan']);
Route::get('lowongan/hapus', [AdminLowonganController::class, 'hapusLowongan']);
