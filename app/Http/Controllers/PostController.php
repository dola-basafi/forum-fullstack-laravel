<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
  function destroy(Request $request, $idPost)
  {
    $delete = Post::find($idPost);
    if ($delete) {
      if ($delete->user_id != $request->user()->id) {
        $logInfo = $request->user()->username . " " . "mencoba mengubah data yang bukan milik nya";
        Log::info($logInfo);
        return redirect()->route('postIndex')->with('error', 'ada tidak punya akses untuk mengubah data ini');
      }
    } else {
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
    }
    $delete->delete();
    return redirect()->route('postIndex')->with('success', 'berhasil delete postingan');
  }
  function edit(Request $request, $idPost)
  {
    $data = Post::with('user:id,name', 'category:id,name')->find($idPost);
    if (!$data) {
      return redirect()->route('postIndex')->with('error', 'data ini tidak ada di database');
    }
    if ($data->user_id != $request->user()->id) {
      $logInfo = $request->user()->username . " " . "mencoba mengubah data yang bukan milik nya";
      Log::info($logInfo);
      return redirect()->route('postIndex')->with('error', 'ada tidak punya akses untuk mengubah data ini');
    }
    $data->Datacategory = Category::all();
    return view('post.edit', compact('data'));
  }
  function mypost(Request $request)
  {
    $data = Post::with('user:id,name')->where('user_id', '=', $request->user()->id)->get();
    return view('post.mypost', compact('data'));
  }
  function detail($id, Request $request)
  {

    $data = Post::with('user:id,name', 'comment.user:id,name', 'like.user:id,name')->withCount([
      'like as likes_count' => function ($query) {
        $query->where('like', 1);
      },
      'like as dislikes_count' => function ($query) {
        $query->where('like', 2);
      }
    ])->find($id);
    return view('post.detail', compact('data'));
  }
  function index()
  {
    $data = Post::with('user:id,name', 'category:id,name')->get();
    return view('post.index', compact('data'));
  }
  function create()
  {
    $category = Category::all();
    return view('post.create', compact('category'));
  }
  function store(Request $request)
  {
    $validate = $request->validate([
      'title' => ['required'],
      'body' => ['required'],
      'category_id' => ['required'],
    ], [
      'required' => ':attribute tidak boleh kosong'
    ]);
    $validate['user_id'] = $request->user()->id;
    Post::create($validate);
    return redirect()->route('home')->with('success', 'berhasil membuat post');
  }
  function update(Request $request, $idPost)
  {
    $post = Post::find($idPost);
    if ($post) {
      if ($post->user_id != $request->user()->id) {
        $logInfo = $request->user()->username . " " . "mencoba mengubah data yang bukan milik nya";
        Log::info($logInfo);
        return redirect()->route('postIndex')->with('error', 'ada tidak punya akses untuk mengubah data ini');
      }
    } else {
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
    }
    $validate = $request->validate([
      'title' => ['required'],
      'body' => ['required'],
      'category_id' => ['required'],
    ], [
      'required' => ':attribute tidak boleh kosong'
    ]);
    $post->update($validate);
    return redirect()->route('postIndex')->with('success', 'berhasil membuat post');
  }
}
