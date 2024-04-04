<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
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
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = Auth::user()->id;
        try {
            $comment->save();
        } catch (\Exception $e){
            return back()->with('message', 'コメントの追加に失敗しました。');
        }

        return back()->with('message', 'コメントを追加しました。');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->content = $request->input('content')?$request->input('content'):$comment->content;
        $comment->post_id = $request->input('post_id')? $request->input('post_id'):$comment->post_id;
        $comment->user_id = Auth::user()->id;
        try {
            $comment->update();
        } catch (\Exception $e) {
            return back()->with('message', 'コメントを編集出来ませんでした。');
        }

        return back()->with('message', 'コメントを編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'コメントを削除出来ませんでした。');
        }
        return  back()->with('message', 'コメント削除しました。');
    }
}
