<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
})->name('home');


/**
 * User related routes
 */
Route::get('/login', [UserController::class, 'create'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

/** for first attempt */
Route::get('/update-password', [PasswordController::class, 'create'])
    ->middleware('auth');
Route::post('/update-password', [PasswordController::class, 'store'])
    ->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register')
    ->middleware('admin');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('admin');

Route::get('/profile', [UserController::class, 'show'])
    ->name('profile')
    ->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'edit'])
    ->name('profile.edit')
    ->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');
Route::delete('/profile', [UserController::class, 'destory'])
    ->name('profile.delete')
    ->middleware('auth');

