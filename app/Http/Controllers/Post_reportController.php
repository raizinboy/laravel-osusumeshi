<?php

namespace App\Http\Controllers;

use App\Models\Post_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Post_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        $post_report = new Post_report();
        $post_report->email = $request->input('email');
        $post_report->category = $request->input('category');
        $post_report->content = $request->input('content');
        $post_report->post_id = $request->input('post_id');
        $post_report->user_id = Auth::user()->id;
        try {
            $post_report->save();
        } catch (\Exception $e) {
            return back()->with('message', '報告出来ませんでした。');
        }
        return back()->with('message', '報告を受け付けました。');
    }
}
