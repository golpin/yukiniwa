<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


Route::get('/', [PostController::class, 'guest'])->name('guest');

Route::middleware('auth:users')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::post('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('update');
});


require __DIR__ . '/auth.php';
