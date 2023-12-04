<?php

namespace App\Http\Controllers;

use App\Jobs\SendReportMail;
use App\Mail\ReportEmail;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
  function detail($idPost){
    $data = Report::with('user:id,name')->where('post_id',$idPost)->get();
    $post = Post::find($idPost);
    return view('admin.detail',compact('data','post'));
  }
  function index(){    
    $data = Post::with('user:id,name')->withCount(['report'])->get();

    return view('admin.index', compact('data'));
  }
  function confirm($idPost){
    $data = Post::find($idPost);
    return view('admin.report',compact('data'));
  }
  function destroy($idPost,Request $request,$idUser){
    $delete = Post::find($idPost);
    if (!$delete) {  
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
    }
    $validate = $request->validate([      
      'body' => ['required'],
    ], [
      'required' => ':attribute tidak boleh kosong'
    ]);
    $user = User::find($idUser);   
    // queue
    dispatch(new SendReportMail($user->email,$user->name,$request->body));
    
    $delete->delete();

    $this->cachePost();
    return redirect()->route('postIndex')->with('success', 'berhasil delete postingan');
  }
  function cachePost(){
    $data = Post::with('user:id,name', 'category:id,name')->get();
    RedisController::put('all_post',$data);
  }
}
