<?php

use App\Http\Controllers\AdminLowonganController;
use App\Http\Controllers\AdminSoalController;
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
Route::get('lowongan/delete', [AdminLowonganController::class, 'deleteLowongan']);

Route::get('soal/batch/get', [AdminSoalController::class, 'getBatchSoal']);
Route::get('soal/batch/add', [AdminSoalController::class, 'addBatchSoal']);
Route::get('soal/batch/edit', [AdminSoalController::class, 'editBatchSoal']);
Route::get('soal/batch/delete', [AdminSoalController::class, 'deleteBatchSoal']);

Route::get('soal/batch/soal/get', [AdminSoalController::class, 'getSoal']);
Route::get('soal/batch/soal/add', [AdminSoalController::class, 'addSoal']);
Route::get('soal/batch/soal/edit', [AdminSoalController::class, 'editSoal']);
Route::get('soal/batch/soal/delete', [AdminSoalController::class, 'deleteSoal']);


