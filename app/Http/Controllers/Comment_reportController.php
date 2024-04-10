<?php

namespace App\Http\Controllers;

use App\Models\Comment_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comment_reportController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        $comment_report = new Comment_report();
        $comment_report->email = $request->input('email');
        $comment_report->category = $request->input('category');
        $comment_report->content = $request->input('content');
        $comment_report->comment_id = $request->input('comment_id');
        $comment_report->user_id = Auth::user()->id;
        try {
            $comment_report->save();
        } catch (\Exception $e) {
            return back()->with('message', '報告出来ませんでした。');
        }
        return back()->with('message', '報告を受け付けました。');
    }
}
