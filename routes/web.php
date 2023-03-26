<?php

use App\Http\Controllers\{PasswordController, UserController, IdeaReportController, CsvExportController, reportQACoordinatorController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, AdminDeletedUserController, AdminUserController, IdeaController, IdeaReactionController, NewsFeedController, EventController, IdeaCommentController, SessionController, UserDashboardController};
use App\Http\Controllers\{RoleEntryController, CategoryController, DepartmentController, CommentController};

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

Route::get('/', function() {
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'admin')
    {
        return view('home');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'qa coordinator')
    {
        return view('home');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'qa manager')
    {
        return redirect()->route('ideas.feed');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'staff')
    {
        return redirect()->route('ideas.feed');
    }
})->name('home')->middleware('auth');


/** login, logout and handling user passwords */
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SessionController::class, 'create'])->name('session.create');
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});


/** Admin related User CRUD routes */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    /** section of admin-panel where admin controls the user account CRUD operations */
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/user/register', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/user/{user:id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/user/{user:id}/update', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/{user:id}/destroy', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    /** section of admin-panel where admin can reactivate the user accounts */
    Route::get('/users/deleted', [AdminDeletedUserController::class, 'index'])->name('admin.users.deleted.index');
    Route::put('/users/deleted/{id}/reactivate', [AdminDeletedUserController::class, 'reactivate'])->name('admin.users.deleted.reactivate');
    Route::delete('/users/deleted/{id}/destroy', [AdminDeletedUserController::class, 'destroy'])->name('admin.users.deleted.destroy');
    
    /** section of admin-panel where admin controls his own account/profile updates */
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
});

/** section of user-panel where user controls his own account/profile updates */
Route::middleware(['auth'])->group(function() {
    Route::get('/users', [UserController::class, 'show'])->name('user.show');         /** to check other people's profiles  */
    Route::get('/{user:username}/profile', [UserController::class, 'profile'])->name('user.profile');   /** own profile */
    Route::get('/{user:username}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{user:username}/update', [UserController::class, 'update'])->name('user.update');
    
    Route::put('/update-password', [PasswordController::class, 'store'])->name('password.update');
});

/** displaying ideas, commeting and reactions in userpanel */
Route::middleware(['auth'])->group(function() {
    Route::get('/newsfeed', [NewsFeedController::class, 'index'])->name('ideas.feed');
    Route::post('/idea/{idea:id}/like', [IdeaReactionController::class, 'like'])->name('like');
    Route::post('/idea/{idea:id}/unlike', [IdeaReactionController::class, 'unlike'])->name('unlike');
    Route::post('/idea/{idea:id}/comment', [IdeaCommentController::class, 'store'])->name('idea.comments.store');
    Route::get('/idea/{idea:id}/comment', [IdeaCommentController::class, 'index'])->name('idea.comments.index');
    Route::get('/user-idea-create', [IdeaController::class, 'userCreate'])->name('idea.users.create');
});

/** shared functionalities between admin panel and user panel  */
Route::middleware(['auth'])->group(function() {
    Route::resource('ideas', IdeaController::class);
    Route::resource('comments', CommentController::class);
});



// (for not working with seeder yet)
// Route::resource('departments', DepartmentController::class);


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
