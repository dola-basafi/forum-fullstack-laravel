<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  function detail($id){
    $data = Post::with('user:id,name','comment.user:id,name')->withCount('like')->find($id);    
    return view('post.detail',compact('data'));
  }
  function index(){
    $data = Post::with('user:id,name','category:id,name')->get();
    return view('post.index',compact('data'));
  }
  function create(){
    $category = Category::all();    
    return view('post.create',compact('category'));
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
    return redirect()->route('home')->with('success','berhasil membuat post');
  }

}
