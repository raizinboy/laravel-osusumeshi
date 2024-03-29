<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\WebController;
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

Route::get('/', [WebController::class, 'index'])->name('top');

Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

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
    });

    Route::resource('posts', PostController::class);
    Route::get('posts/ikitai/{id}', [PostController::class, 'ikitai'])->name('posts.ikitai');
    Route::get('posts/emparhy/{id}', [PostController::class, 'empathy'])->name('posts.empathy');

    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
});
    Route::post('posts/create/ajax', [AjaxController::class, 'getCityOptions'])->name('getcity.ajax');

