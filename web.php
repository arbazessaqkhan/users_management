<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

//add user 
Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');

//store user 
Route::get('/store', [App\Http\Controllers\UserController::class, 'store'])->name('store');


//show all users
Route::get('/show', [App\Http\Controllers\UserController::class, 'show'])->name('show');

//edit user
Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');

//add user 
Route::get('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');

//add user 
Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');

