<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {

Route::get('/createform',[PostController::class,'create'])->name('user.create');

Route::post('/createform',[PostController::class,'store'])->name('user.create');

Route::get('posts',[PostController::class,'userspost'])->name('post.show');

Route::put('posts/{post}',[PostController::class,'updatepost']);

Route::delete('post/{id}',[PostController::class,'destroy']);

Route::get('/post/{id}',[PostController::class,'show']);

Route::post('/post/{post}/comment',[CommentsController::class,'store']);


Route::get('/details/{comments}',[CommentsController::class,'details'])->name('post.details');

Route::get('/status/{id}',[PostController::class,'poststatus']);

Route::get('/statusprivate/{id}',[PostController::class,'statusprivate']);

});
