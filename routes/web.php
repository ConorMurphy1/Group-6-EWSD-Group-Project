<?php

use App\Http\Controllers\{AdminReportController, PasswordController, UserController, IdeaReportController, CsvExportController, reportQACoordinatorController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, AdminDeletedUserController, AdminUserController, IdeaController, IdeaReactionController, NewsFeedController, EventController, IdeaCommentController, SessionController, UserDashboardController};
use App\Http\Controllers\{CategoryController, DepartmentController, CommentController, RoleController};

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

/** Home route just serves as a redirector between admin level access users and normal users */
Route::get('/', function() {
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'admin')
    {
        return redirect()->route('dashboard');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'qa manager')
    {
        return redirect()->route('dashboard');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'qa coordinator')
    {
        return redirect()->route('ideas.feed');
    }
    if(auth()->user() && strtolower(auth()->user()->role->role) == 'staff')
    {
        return redirect()->route('ideas.feed');
    }
})->name('home')->middleware('auth');



/** Login, Logout */
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SessionController::class, 'create'])->name('session.create');
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});



/** Admin and QAC's shared routes */
Route::prefix('admin')->middleware(['auth', 'admin_access'])->group(function() {

    // Dashboard
    Route::get('/dashboard', fn() => view('home'))->name('dashboard');

    // CSV Exports
    Route::resource('/export-csv', CsvExportController::class);
    Route::get('/export-csv-download', [IdeaController::class,'exportToCSV'])->name('export-csv-download');
    Route::get('/export-csv', [CsvExportController::class, 'index'])->name('export-csv');
    Route::get('/download-document', [IdeaController::class, 'downloadDocument'])->name('download-document');

    // Closure Dates (Events)
    Route::resource('events', EventController::class);

    // Statistical Analysis
    Route::resource('/stats', IdeaReportController::class );

    // Idea and Comment (To allow QAM to remove reported ideas and comments)
    Route::resource('ideas', IdeaController::class);
    Route::resource('comments', CommentController::class);
});



/** Admin Only Accessed routes */
Route::prefix('admin')->middleware(['auth', 'admin_only'])->group(function() {

    // Admin User CRUD
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/user/register', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/user/{user:id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/user/{user:id}/update', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/{user:id}/destroy', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin User Soft Delete UD
    Route::get('/users/deleted', [AdminDeletedUserController::class, 'index'])->name('admin.users.deleted.index');
    Route::put('/users/deleted/{id}/reactivate', [AdminDeletedUserController::class, 'reactivate'])->name('admin.users.deleted.reactivate');
    Route::delete('/users/deleted/{id}/destroy', [AdminDeletedUserController::class, 'destroy'])->name('admin.users.deleted.destroy');

    // Admin Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Role Department CRUD
    Route::resource('roles', RoleController::class);
    Route::resource('departments', DepartmentController::class);

    // Idea and Comment
    Route::resource('ideas', IdeaController::class);
    Route::resource('comments', CommentController::class);
});



/** QAM Only Accessed routes */
Route::prefix('admin')->middleware(['auth', 'qam_only'])->group(function() {

    // Category Idea Comment CRUD
    Route::resource('categories', CategoryController::class);

    // Reported Ideas and Comments RD
    Route::get('/reports/ideas', [AdminReportController::class, 'reportedIdeas'])->name('admin.reports.ideas');
    Route::get('/reports/comments', [AdminReportController::class, 'reportedComments'])->name('admin.reports.comments');
    Route::delete('/reports/{ideaReport}/destroy', [AdminReportController::class, 'destroyIdea'])->name('admin.reports.ideas.destroy');
    Route::delete('/reports/comments/{commentReport}/destroy', [AdminReportController::class, 'destroyComment'])->name('admin.reports.comments.destroy');
});



/** Only Staff and Admin can post ideas */
Route::middleware(['auth', 'constraint'])->group(function() {
    Route::get('/idea/create', [IdeaController::class, 'userCreate'])->name('idea.users.create');
    Route::post('/idea/create', [IdeaController::class, 'userStore'])->name('idea.users.store');
    Route::get('/idea/edit/{idea:id}', [IdeaController::class, 'userEdit'])->name('idea.users.edit');
    Route::put('/idea/{idea:id}', [IdeaController::class, 'userUpdate'])->name('idea.users.update');
    Route::delete('/idea/{idea:id}', [IdeaController::class, 'userDelete'])->name('idea.users.delete');

    Route::get('newsfeed/events', [NewsFeedController::class, 'events'])->name('events.newsfeed');
});



/** Global Accessed Routes: Every role can access these routes if they are authenticated */
Route::middleware(['auth'])->group(function() {
    Route::get('/users', [UserController::class, 'show'])->name('user.show');         /** to check other people's profiles  */
    Route::get('/{user:username}/profile', [UserController::class, 'profile'])->name('user.profile');   /** own profile */
    Route::get('/{user:username}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{user:username}/update', [UserController::class, 'update'])->name('user.update');

    Route::put('/update-password', [PasswordController::class, 'store'])->name('password.update');
    Route::resource('/analytics', reportQACoordinatorController::class );        // statistical report for both admin and QA Manager

    Route::get('/newsfeed', [NewsFeedController::class, 'index'])->name('ideas.feed');
    Route::get('/newsfeed/search', [NewsFeedController::class, 'search'])->name('ideas.search');
    Route::post('/idea/{idea:id}/like', [IdeaReactionController::class, 'like'])->name('like');
    Route::post('/idea/{idea:id}/unlike', [IdeaReactionController::class, 'unlike'])->name('unlike');

    Route::get('/idea/{idea:id}/comment', [IdeaCommentController::class, 'index'])->name('idea.comments.index');
    Route::post('/idea/{idea:id}/comment', [IdeaCommentController::class, 'store'])->name('idea.comments.store');
    Route::get('/idea/{idea:id}/comment/{comment:id}/edit', [IdeaCommentController::class, 'edit'])->name('idea.comments.edit');
    Route::put('/idea/{idea:id}/comment/{comment:id}', [IdeaCommentController::class, 'update'])->name('idea.comments.update');
    Route::delete('/idea/{idea:id}/comment/{comment:id}', [IdeaCommentController::class, 'destroy'])->name('idea.comments.destroy');


    Route::post('/idea/{idea:id}/report', [IdeaController::class, 'report'])->name('report');
    Route::post('/idea/{idea:id}/comment/{comment:id}/report', [IdeaCommentController::class, 'report'])->name('comment.report');
});

