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
    Route::get('/departments',[DepartmentController::class,'showDepartments']);
    Route::post('/departments',[DepartmentController::class,'addDepartment']);
    Route::delete('/departments/{id}',[DepartmentController::class,'deleteDepartment']);
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'editDepartment']);
    Route::put('/departments/{id}', [DepartmentController::class, 'updateDepartment']);

    /**
     * Idea(Dashboard) related routes
     */
    Route::resource('ideas', IdeaController::class);

    /**
     * Role Entry related routes
     */
    // Route::view('role','roleEntry');
    // Route::get('role',[RoleController::class,'show']);
    // Route::post('role',[RoleController::class,'AddRole']);
    // Route::get('deleteRole/{id}',[RoleController::class,'deleteRole']);
    // Route::get('updateRole/{id}',[RoleController::class,'showdata']);
    // Route::put('/updateRole/{id}', [RoleController::class, 'updateRole']);

    Route::resource('role', RoleEntryController::class);
    Route::get('role/{id}/delete',[RoleEntryController::class,'destroy']);
    Route::put('role/{id}/edit', [RoleEntryController::class, 'update']);

    /**
     * Report
     */
    Route::view('report','report.index');




});
