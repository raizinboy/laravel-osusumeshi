<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Ikitai;
use App\Models\Empathy;
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

        if(session('message')){
            $message = session('message');
        } else {
            $message ="";
        }

        return view('posts.index', compact('posts', 'message'));
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
            'prefecture_id' => 'required',
            'city' => 'required',
            'shop_name' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $filename="";
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
        $post->prefecture_id = $request->input('prefecture_id');
        $post->city = $request->input('city');
        $post->user_id = Auth::user()->id;
        $post->shop_name  = $request->input('shop_name');
        $post->title = $request->input('title');
        $post->image = $filename;
        $post->content = $request->input('content');
        $post->save();

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = Auth::user();

        $comments = $post->comments()->get();

        return view('posts.show',compact('post', 'user', 'comments'));
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
            'prefecture_id' => 'required',
            'shop_name' => 'required',
            'city' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $filename="";
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
        $post->prefecture_id = $request->input('prefecture_id') ? $request->input('prefecture_id'):$post->prefecture_id;
        $post->city = $request->input('city') ? $request->input('city'): $post->city;
        $post->shop_name  = $request->input('shop_name') ? $request->input('shop_name') : $post->shop_name;
        $post->title = $request->input('title') ? $request->input('title') : $post->title;
        $post->image = $filename;
        $post->content = $request->input('content')? $request->input('content') : $post->content;
        $post->update();

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $message = "投稿を削除しました。";

        return to_route('posts.index')->with(compact('message'));
    }

    public function ikitai($id)
    {
        if(Ikitai::where('post_id', $id)->where('user_id', Auth::id())->exists()) {
            $ikitai = Ikitai::where('post_id', $id)->where('user_id', Auth::id())->first();
            $ikitai->delete();
        } else {
            $ikitai_data = new Ikitai();
            $ikitai_data->post_id = $id;
            $ikitai_data->user_id = Auth::id();    
            $ikitai_data->save();
        }

        $prev_url = url()->previous();
        $redirect_url = $prev_url."#".$id;

        return redirect($redirect_url);
    }

    public function empathy($id)
    {
        if(Empathy::where('post_id', $id)->where('user_id', Auth::id())->exists()) {
            $empathy = Empathy::where('post_id', $id)->where('user_id', Auth::id())->first();
            $empathy->delete();
        } else {
            $empathy_data = new Empathy();
            $empathy_data->post_id = $id;
            $empathy_data->user_id = Auth::id();
            $empathy_data->save();
        }

        $prev_url = url()->previous();
        $redirect_url = $prev_url."#".$id;
        
        return redirect($redirect_url);
    }
}
