<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
  function store(Request $request, $idPost)
  {
    $validate = $request->validate([
      'body' => ['required']
    ], [
      'required' => ":attribute tidak boleh kosong"
    ]);
    $validate['user_id']  = $request->user()->id;
    $validate['post_id']  = $idPost;
    Comment::create($validate);
    return redirect()->route('postDetail', $idPost)->with('success', 'comment berhasil di buat');
  }
  function update(Request $request, $idPost, $idComment)
  {
    $comment = Comment::find($idComment);
    if (!$comment) {
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
    }
    if ($comment->user_id != $request->user()->id) {
      $logInfo = $request->user()->username +" "+ "mencoba mengubah data yang bukan milikiknya";
      Log::info($logInfo);
      return redirect()->route('postIndex')->with('error', 'ada tidak punya akses untuk mengubah data ini');
    }
    $validate = $request->validate([
      'body' => ['required']
    ], [
      'required' => ":attribute tidak boleh kosong"
    ]);

    $comment->update($validate);
    return redirect()->route('postDetail', $idPost)->with('success', 'comment berhasil di update');
  }
  function destroy(Request $request,$idPost,$idComment)
  {
    $delete = Comment::find($idComment);
    if (!$delete) {
      return redirect()->route('postIndex')->with('error', 'data yang anda cari tidak di temukan');
      
    }
    if ($delete->user_id != $request->user()->id) {
      $logInfo = $request->user()->username +" "+ "mencoba mengubah data yang bukan milikiknya";
      Log::info($logInfo);
      return redirect()->route('postIndex')->with('error', 'ada tidak punya akses untuk mengubah data ini');
    }
    $delete->delete();
    return redirect()->route('postDetail', $idPost)->with('success', 'comment berhasil di hapus');

  }
}
