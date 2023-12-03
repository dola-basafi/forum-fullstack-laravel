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
  return redirect()->route('home');
});

Auth::routes();

Route::get('/home', function(){
  return redirect()->route('postIndex');
})->name('home');
Route::prefix('post')->group(function(){
  Route::controller(PostController::class)->group(function(){
    Route::get('/index','index')->name('postIndex');
    Route::get('/detail/{id}','detail')->name('postDetail');
    Route::middleware(['auth'])->group(function(){
      Route::get('/create','create')->name('postForm');
      Route::post('/create', 'store')->name('postStore');
      Route::get('/mypost','mypost')->name('mypost');
      Route::get('/edit/{idPost}','edit')->name('editPost');
      Route::post('/edit/{idPost}','update')->name('updatePost');
      Route::delete('/delete/{idPost}','destroy')->name('postDelete');
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
