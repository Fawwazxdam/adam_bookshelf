<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('dashboard', function () {
//     return view('dashboard');
// });
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/kategori', KategoriController::class);
    Route::get('/delkat/{kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('delkat');
    Route::resource('/user', UserController::class);
    Route::get('/delus/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delus');
    
});
Route::middleware(['auth', 'editor'])->group(function () {
    Route::resource('/book', BookController::class);
    Route::get('/delbuk/{book}', [App\Http\Controllers\BookController::class, 'destroy'])->name('delbuk');
    
});

Route::resource('/dashboard', DashboardController::class);