<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IdeaReportController;
use App\Http\Controllers\CsvExportController;
use App\Http\Controllers\reportQACoordinatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IdeaController, IdeaReactionController, NewsFeedController, EventController, IdeaCommentController, UserDashboardController};
// For Role Entry
use App\Http\Controllers\RoleEntryController;

// For Category
use App\Http\Controllers\CategoryController;

// For Department
use App\Http\Controllers\DepartmentController;

// For Comments
use App\Http\Controllers\CommentController;
use App\Models\IdeaReaction;

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




/**
 * User related routes
 */
Route::get('/login', [UserController::class, 'create'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth')->name('logout');

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
    Route::get('/newsfeed', [NewsFeedController::class, 'index'])->name('ideas.feed');
});

/**
 * Idea Reactions
 */
Route::middleware(['auth'])->group(function() {
    Route::post('/idea/{idea:id}/like', [IdeaReactionController::class, 'like'])->name('like');
    Route::post('/idea/{idea:id}/unlike', [IdeaReactionController::class, 'unlike'])->name('unlike');
});

/**
 * Comment CRUD 
 * Comment that relates to the specific idea
 */
Route::middleware(['auth'])->group(function() {
    Route::get('/idea/{idea:id}/comment', [IdeaCommentController::class, 'index'])->name('idea.comments.index');
    Route::post('/idea/{idea:id}/comment', [IdeaCommentController::class, 'store'])->name('idea.comments.store');
});

Route::resource('comments', CommentController::class);

// (for not working with seeder yet)
// Route::resource('departments', DepartmentController::class);

Route::get('/', function() {
    return view('home');
})->name('home')->middleware('auth');

// dd(auth()->user());
// if (auth()->user()->role->role === "Admin"){
// Route::group(['middleware' => ['web', 'auth']], function(){
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    /**
     * Category(Dashboard) related routes
     */
    Route::resource('categories', CategoryController::class);

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
    // Route::resource('report',[IdeaReportController::class, 'chartData']);
    Route::resource('report', IdeaReportController::class );
    Route::resource('reportQACoordinator', reportQACoordinatorController::class );

    /**
     * CSV Export
     */
    Route::resource('/export-csv', CsvExportController::class);
    Route::get('/export-csv-download', [IdeaController::class,'exportToCSV'])->name('export-csv-download');
    Route::get('/export-csv', [CsvExportController::class, 'index'])->name('export-csv');
    Route::get('/download-document', [IdeaController::class, 'downloadDocument'])->name('download-document');

    /**
     * Event
     */
    Route::resource('events', EventController::class);

});
// }
// else{

  
Route::group(['middleware' => ['web', 'auth']], function(){

    });
// }


// Route::get('posts', [UserDashboardController::class, 'posts'])->name('user.posts');
