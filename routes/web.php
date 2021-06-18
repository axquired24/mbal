<?php

use Illuminate\Support\Facades\Route;

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
//     return view('auth/login');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\DocumentsController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\DocumentsController::class, 'index'])->name('home');

Route::get('/documents', [App\Http\Controllers\DocumentsController::class, 'index'])->name('documents');
Route::get('/upload', [App\Http\Controllers\DocumentsController::class, 'create'])->name('upload');
Route::post('/store', [App\Http\Controllers\DocumentsController::class, 'store'])->name('store');
Route::put('/update/{id}', [App\Http\Controllers\DocumentsController::class, 'update'])->name('update');
Route::get('/search', [App\Http\Controllers\DocumentsController::class, 'search'])->name('search');

Route::delete('/destroy/{id}', [App\Http\Controllers\DocumentsController::class, 'destroy'])->name('destroy');
Route::get('/files/{id}', [App\Http\Controllers\DocumentsController::class, 'show'])->name('show');
Route::get('/edit/{id}', [App\Http\Controllers\DocumentsController::class, 'edit'])->name('edit');

Route::get('/file/download/{file}', [App\Http\Controllers\DocumentsController::class, 'download'])->name('download');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
