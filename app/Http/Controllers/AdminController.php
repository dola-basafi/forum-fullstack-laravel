<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  function index(){
    // $data = Post::with('user:id,name', 'category:id,name')->get();
    
    $data = Post::with('user:id,name')->withCount(['report'
      
    ])->get();

    return view('admin.index', compact('data'));
  }
  function confirm($idPost){

    return view('admin.report',["data" => $idPost]);
  }
  function destroy($idPost,Request $request){
    $delete = Post::find($idPost);
    if (!$delete) {  
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
    }
    $validate = $request->validate([      
      'body' => ['required'],
    ], [
      'required' => ':attribute tidak boleh kosong'
    ]);
    dd($request->body);
    $delete->delete();
    return redirect()->route('postIndex')->with('success', 'berhasil delete postingan');
  }
}
