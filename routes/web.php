<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\Role;
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
      Route::post('/update/{idPost}/{idComment}','update')->name('commentUpdate');
      Route::delete('/delete/{idPost}/{idComment}','destroy')->name('commentDelete');
    });
  });
});

Route::prefix('report')->group(function(){
  Route::controller(ReportController::class)->group(function(){
    Route::middleware(['auth'])->group(function(){
      // Route::get('/{idPost}','setReport')->name('setReport');
      Route::Post('/{idPost}','setReport')->name('setReport');
    });
  });
});

Route::prefix('like')->group(function(){
  Route::controller(LikeController::class)->group(function(){
    Route::middleware(['auth'])->group(function(){
      Route::get('/like/{id}/{like}','setLike')->name('like');
    });
  });
});

Route::prefix('admin')->group(function(){
  Route::middleware(['auth','Role:1'])->group(function(){
    Route::get('/detail/{idPost}',[AdminController::class,'detail'])->name('adminDetail');
    Route::get('/index',[AdminController::class,'index'])->name('adminIndex');
    Route::get('/confirmasi/{idPost}/{idUser}',[AdminController::class,'confirm'])->name('reporConfirm');
    Route::post('/delete/{idPost}/{idUser}',[AdminController::class,'destroy'])->name('reportDelete');
  });
});
