<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefectures = Prefecture::all();

        return view('posts.create', compact('prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => [
                'file',
                'image',
                'mimes:jpeg,png',
            ],
        ]);

        $image = $request->file('image');
        if( isset($image) === true) {
            //拡張子を取得
            $ext = $image->guessExtension();
            //アップロードファイル名は[ランダム文字列20文字].[拡張子];
            $filename = str_random(20). ".{$ext}";
            // publicディレクトリのphotoディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->shop_name  = $request->input('shop_name');
        $post->title = $request->input('title');
        $post->image = $filename;
        $post->content = $request->input('content');
        $post->save();

        return view('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $prefectures = prefecture::all();

        

        return view('posts.edit', compact('prefectures', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        Storage::disk('public')->delete('photos/'.$request->input('image_delete'));

        $request->validate([
            'image' => [
                'file',
                'image',
                'mimes:jpeg,png',
            ],
        ]);

        $image = $request->file('image');
        if( isset($image) === true) {
            //拡張子を取得
            $ext = $image->guessExtension();
            //アップロードファイル名は[ランダム文字列20文字].[拡張子];
            $filename = str_random(20). ".{$ext}";
            // publicディレクトリのphotoディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }

        $post->user_id = Auth::user()->id;
        $post->shop_name  = $request->input('shop_name') ? $request->input('shop_name') : $post->shop_name;
        $post->title = $request->input('title') ? $request->input('title') : $post->title;
        $post->image = $filename;
        $post->content = $request->input('content')? $request->input('content') : $post->content;
        $post->update();

        return view('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
