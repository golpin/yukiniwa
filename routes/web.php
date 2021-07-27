<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;


//全てのユーザー
Route::get('/', [PostController::class, 'guest'])->name('guest');
//Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
//認証されたユーザーのみ
Route::middleware('auth:users')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::get('/mypost', [PostController::class, 'mypost'])->name('mypost');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::post('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('update');

    Route::get('/myprofile', [ProfileController::class, 'myprofile'])->name('profile.myprofile');
});               



require __DIR__ . '/auth.php';
