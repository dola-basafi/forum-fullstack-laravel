<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(Request $request ,$idPost){
      $validate = $request->validate([
        'body' => ['required']
      ],[
        'required' => ":attribute tidak boleh kosong"
      ]);
      $validate['user_id']  = $request->user()->id;
      $validate['post_id']  = $idPost;
      Comment::create($validate);
      return redirect()->route('postDetail',$idPost)->with('success','comment berhasil di buat');      
    }



}
