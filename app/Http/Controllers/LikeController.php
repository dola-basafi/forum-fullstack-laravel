<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  function setLike($id, Request $request,$like)
  {
    
    if ($like != 1 && $like != 2) {
      return redirect()->route('postIndex');
    }
    $post = Post::find($id);
    if (!$post) {
      return redirect()->route('postIndex')->with('error', 'data ini tidak ada di database');
    }
    $dataLike = Like::where('user_id',$request->user()->id)->where('post_id',$id)->first();
    if ($dataLike) {
      if ($dataLike->like != $like) {
        $dataLike->like = $like;
        $dataLike->save();
      }else{
        $dataLike->delete();
      }
      
    }else{
      Like::create([
        'like' => $like,
        'user_id' => $request->user()->id,
        'post_id' => $id
      ]);
    }
    return redirect()->route('postDetail',$id);

  }
}
