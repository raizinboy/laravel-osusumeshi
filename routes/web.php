<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Post_reportController;
use App\Http\Controllers\Comment_reportController;

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

Route::get('/', [WebController::class, 'index'])->name('top');

Auth::routes(['verify' => true]);

Route::post('posts/create/ajax', [AjaxController::class, 'getCityOptions'])->name('getcity.ajax');

//メール認証できていない場合はここに記載されているルートにはアクセスできない
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(UserController::class)->group(function() {
        Route::get('users/{id}', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::delete('users/mypage/destroy', 'destroy')->name('mypage.destroy');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
        Route::get('users/mypage/ikitai', 'show_ikitai')->name('mypage.show_ikitai');
        Route::get('users/mypage/empathy', 'show_empathy')->name('mypage.show_empathy');
    });

    Route::post('users/mypage/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::put('users/mypage/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('posts', PostController::class);
    Route::post('posts/ikitai/{id}', [PostController::class, 'ikitai'])->name('posts.ikitai');
    Route::post('posts/empathy/{id}', [PostController::class, 'empathy'])->name('posts.empathy');

    Route::post('posts/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::put('posts/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('posts/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::post('posts/post_report', [Post_reportController::class, 'store'])->name('post_report.store');
    Route::post('posts/comment_report', [Comment_reportController::class, 'store'])->name('comment_report.store');
});
