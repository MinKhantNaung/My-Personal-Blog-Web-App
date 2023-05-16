<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UiController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\User\CommentController;
use App\Models\Student;

Route::get('/', [UiController::class, 'index'])->name('main');
// for portfolio page
Route::get('/portfolio', [UiController::class, 'portfolio'])->name('portfolio');
// for blogs page
Route::get('/blogs', [UiController::class, 'blogs'])->name('blogs');
// for filter posts by category
Route::get('/blogs/filter-by-categories/{id}', [UiController::class, 'filter'])->name('blogs.filter');

Route::middleware(['auth'])->group(function () {
    // Admin
    Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Account
        Route::group(['prefix' => 'account'], function () {
            // for admin acc detail page
            Route::get('/detail', [AdminController::class, 'detail'])->name('admin.detail');
            // for acc edit page
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
            // for acc update
            Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
            // for password change page
            Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
            // for change password
            Route::post('/change-password/{id}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        });

        // Posts
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [PostController::class, 'index'])->name('posts.index');
            // for create posts page
            Route::get('/create', [PostController::class, 'create'])->name('posts.create');
            // for create posts
            Route::post('/create', [PostController::class, 'createPosts'])->name('posts.create');
            // for posts detail page
            Route::get('/detail/{id}', [PostController::class, 'detail'])->name('posts.detail');
            // for edit posts page
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
            // for update posts
            Route::post('/edit/{id}', [PostController::class, 'update'])->name('posts.update');
            // for delete posts
            Route::post('/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
            // for comments of a post
            Route::get('/comments/{id}', [PostController::class, 'manageComments'])->name('posts.comments');
            // for show_hide comments
            Route::post('comments/show-hide/{id}', [PostController::class, 'showHide'])->name('comments.showHide');
        });

        // Projects
        Route::resource('/projects', ProjectController::class);

        // Students
        Route::get('/students', [StudentController::class, 'index'])->name('students');
        // to create student count
        Route::post('/students/create', [StudentController::class, 'create'])->name('students.create');
        // to add student count
        Route::post('/students/add/{id}', [StudentController::class, 'add'])->name('students.add');

        // Skills
        Route::resource('/skills', SkillController::class);

        // Images
        Route::resource('/images', ImageController::class);

        // Categories
        Route::resource('/categories', CategoryController::class);
    });

    // User
    Route::group(['prefix' => 'users', 'middleware' => 'isUser'], function () {
        // for user account detail page
        Route::get('/account/detail', [UserController::class, 'detail'])->name('users.accoountDetail');
        // for edit account page
        Route::get('/account/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        // for update account
        Route::post('/account/update/{id}', [UserController::class, 'update'])->name('users.update');
        // for change password page
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
        // for change password
        Route::post('/change-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
        // for post details when click readmore
        Route::get('/post/detail/{id}', [UiController::class, 'detail'])->name('blogs.detail');

        // Ajax
        Route::prefix('ajax')->group(function () {
            // for click like button in post detail
            Route::get('/like', [AjaxController::class, 'like']);
            // for click dislike button in post detail
            Route::get('/dislike', [AjaxController::class, 'dislike']);
            // for create comment
            Route::get('/comment', [AjaxController::class, 'comment']);
        });
    });
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
