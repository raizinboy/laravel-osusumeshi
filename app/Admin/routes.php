<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\PostController;
use App\Admin\Controllers\CommentController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\Comment_reportController;
use App\Admin\Controllers\Post_reportController;
use App\Admin\Controllers\ProfileController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('posts', PostController::class);
    $router->resource('comments', CommentController::class);
    $router->resource('users', UserController::class);
    $router->resource('comment_reports', Comment_reportController::class);
    $router->resource('post_reports',Post_reportController::class );
    $router->resource('profiles', ProfileController::class);
});
