<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('post')->group(function(){
  Route::controller(PostController::class)->group(function(){
    Route::get('/index','index')->name('postIndex');
    Route::get('/detail/{id}','detail')->name('postDetail');
    Route::middleware(['auth'])->group(function(){
      Route::get('/create','create')->name('postForm');
      Route::post('/create', 'store')->name('postStore');
      Route::post('/edit',[]);
    });
  });
});

Route::prefix('comment')->group(function(){
  Route::controller(CommentController::class)->group(function(){
    Route::middleware(['auth'])->group(function(){
      Route::post('/create/{idPost}','store')->name('commentStore');
    });
  });
});
