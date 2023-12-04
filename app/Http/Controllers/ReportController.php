<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  function setReport(Request $request, $idPost)
  {
    $report = Report::where('user_id', $request->user()->id)->where('post_id', $idPost)->first();
    if ($report) {
      return redirect()->back();
    }
    if (!$request->user()->body) {
      $request->user()->body = 'tidak ada';
    }
    Report::create([
      'user_id' => $request->user()->id,
      'post_id' => $idPost,
      'body' => $request->body,
    ]);
    return redirect()->route('postDetail', $idPost)->with('success', 'berhasil report');
  }

}
