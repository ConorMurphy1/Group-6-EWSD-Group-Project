<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IdeaController, TestController};
// For Role Entry
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\RoleEntryController;

// For Category
use App\Http\Controllers\CategoryController;

// For Department
use App\Http\Controllers\DepartmentController;

// For Comments
use App\Http\Controllers\CommentController;


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
    return view('layouts.app');
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

/** for first attempt - the user will have to update their password for security concerns */
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
Route::delete('/profile', [UserController::class, 'destroy'])
    ->name('profile.delete')
    ->middleware('auth');

/**
 * Newsfeed displaying ideas
 */
Route::middleware(['auth'])->group(function() {
    Route::get('/newsfeed', [NewsFeedController::class, 'index'])->name('newsfeed');
});

/**
 * Idea Reactions
 */
Route::middleware(['auth'])->group(function() {
    Route::post('/ideas/like', [IdeaReactionController::class, 'like'])->name('like');
    Route::post('/ideas/unlike', [IdeaReactionController::class, 'unlike'])->name('unlike');
});

/**
 * Comment CRUD
 */

Route::resource('comments', CommentController::class);

// (for not working with seeder yet)
// Route::resource('departments', DepartmentController::class);

Route::group(['middleware' => ['web', 'auth']], function(){

    /**
     * Category(Dashboard) related routes
     */
    Route::get('category',[CategoryController::class,'showCategory'])->name('category.index');
    Route::post('/category-create',[CategoryController::class,'addCategory']);
    Route::delete('/category/{id}',[CategoryController::class,'deleteCategory']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'editCategory']);
    Route::put('/category/{id}', [CategoryController::class, 'updateCategory']);

    /**
     * Department(Dashboard) related routes
     */
    Route::resource('departments', DepartmentController::class);




    /**
     * Idea(Dashboard) related routes
     */
    Route::resource('ideas', IdeaController::class);

    /**
     * Role Entry related routes
     */


    Route::resource('role', RoleEntryController::class);
    Route::get('role/{id}/delete',[RoleEntryController::class,'destroy']);
    Route::put('role/{id}/edit', [RoleEntryController::class, 'update']);

    /**
     * Report
     */
    Route::view('report','report.index');

});
