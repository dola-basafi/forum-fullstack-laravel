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
    Report::create([
      'user_id' => $request->user()->id,
      'post_id' => $idPost
    ]);
    return redirect()->route('postDetail', $idPost)->with('success', 'berhasil report');
  }

}
