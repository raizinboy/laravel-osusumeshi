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
    public function index(Request $request)
    {
        $posts_array = array();

        $prefecture = "";
        $city = "";
        $shop_name="";

        if($request->input('prefecture_id') !== null){
            if($request->input('city') !== null) {
                if ($request->input('shop_name') !== null){
                    $prefecture = Prefecture::where('id', $request->input('prefecture_id'))->first();
                    $city = $request->input('city');
                    $shop_name = $request->input('shop_name');
                    $posts = Post::where('city', $request->input('city'))->where('shop_name', 'LIKE', "%$shop_name%")->with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
                    $total_count = Post::where('city', $request->input('city'))->where('shop_name', 'LIKE', "%$shop_name%")->count();
                } else {
                    $prefecture = Prefecture::where('id', $request->input('prefecture_id'))->first();
                    $city = $request->input('city');
                    $posts = Post::where('city', $request->input('city'))->with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
                    $total_count = Post::where('city', $request->input('city'))->count();
                }
            } elseif ($request->input('shop_name') !== null){
                $prefecture = $prefecture = Prefecture::where('id', $request->input('prefecture_id'))->first();
                $shop_name = $request->input('shop_name');
                $posts = Post::where('prefecture_id', $request->prefecture_id)->where('shop_name', 'LIKE', "%$shop_name%")->with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
                $total_count = Post::where('prefecture_id', $request->prefecture_id)->where('shop_name', 'LIKE', "%$shop_name%")->count();
            } else {
                $prefecture = Prefecture::where('id', $request->input('prefecture_id'))->first();
                $posts = Post::where('prefecture_id', $request->prefecture_id)->with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
                $total_count = Post::where('prefecture_id', $request->prefecture_id)->count();
            }
        } elseif($request->input('shop_name') !== null){
            $shop_name = $request->input('shop_name');
            $posts = Post::where('shop_name', 'LIKE', "%$shop_name%")->with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
            $total_count = Post::where('shop_name', 'LIKE', "%$shop_name%")->count();
        } else {
            $posts = Post::with('prefecture','user')->sortable()->withCount('ikitais')->withCount('empathies')->paginate(10);
            $total_count = Post::count();
        }
        
        foreach($posts as $post){
            if(Ikitai::where('post_id', $post->id)->where('user_id', Auth::id())->exists()){
                $posts_array["$post->id"] = [
                    'ikitai-label'=>'解除',
                    'ikitai-icon' =>'solid',
                    'ikitai-btn' =>'info',
                    ];
            }   else{
                $posts_array["$post->id"] = [
                    'ikitai-label'=>'行きたい',
                    'ikitai-icon' =>'regular',
                    'ikitai-btn' =>'outline-info',
                ];
            };

            if(Empathy::where('post_id', $post->id)->where('user_id', Auth::id())->exists()){
                $posts_array["$post->id"] +=[
                    'empathy-label'=>'解除',
                    'empathy-icon' =>'solid',
                    'empathy-btn' => 'info',
                ];
            }   else{
                $posts_array["$post->id"] += [
                    'empathy-label'=>'共感',
                    'empathy-icon' =>'regular',
                    'empathy-btn' => 'outline-info',          
                ];
            };
        }

        $prefectures = Prefecture::all();

        return view('posts.index', compact('posts', 'posts_array', 'prefectures', 'prefecture', 'city', 'shop_name', 'total_count'));
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
        $path ="";

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

        $post = new Post();
        $post->prefecture_id = $request->input('prefecture_id');
        $post->city = $request->input('city');
        $post->user_id = Auth::user()->id;
        $post->shop_name  = $request->input('shop_name');
        $post->title = $request->input('title');

        $image = $request->file('image');

        if ( isset($image) == true ){
            $path = Storage::disk('s3')->putFile('/photo', $request->file('image'));
            $post->image = Storage::disk('s3')->url($path);
        } else {
            
        }
        $post->content = $request->input('content');
        try {
        $post->save();
        } catch( \Exception $e) {
            return back()->with('message', '作成に失敗しました。');
        }
        return to_route('posts.index')->with('message', '投稿完了しました。');
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
        
        if(Ikitai::where('post_id', $post->id)->where('user_id', Auth::id())->exists()){
            $posts_array["$post->id"] = [
                'ikitai-label'=>'解除',
                'ikitai-icon' =>'solid',
                'ikitai-btn' =>'info',
                ];
        }   else{
            $posts_array["$post->id"] = [
                'ikitai-label'=>'行きたい',
                'ikitai-icon' =>'regular',
                'ikitai-btn' =>'outline-info',
            ];
        };

        if(Empathy::where('post_id', $post->id)->where('user_id', Auth::id())->exists()){
            $posts_array["$post->id"] +=[
                'empathy-label'=>'解除',
                'empathy-icon' =>'solid',
                'empathy-btn' => 'info',
            ];
        }   else{
            $posts_array["$post->id"] += [
                'empathy-label'=>'行きたい',
                'empathy-icon' =>'regular',
                'empathy-btn' => 'outline-info',
            ];
        };
        
        $comments = $post->comments()->orderByDesc('created_at')->paginate(10);

        return view('posts.show',compact('post', 'user', 'comments', 'posts_array'));
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
        //既存の画像の削除
        $delete_image = ltrim($request->input('image_delete'), 'https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/photo/');
        Storage::disk('s3')->delete('photo/'.$delete_image);

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
        
        $post->user_id = Auth::user()->id;
        $post->prefecture_id = $request->input('prefecture_id') ? $request->input('prefecture_id'):$post->prefecture_id;
        $post->city = $request->input('city') ? $request->input('city'): $post->city;
        $post->shop_name  = $request->input('shop_name') ? $request->input('shop_name') : $post->shop_name;
        $post->title = $request->input('title') ? $request->input('title') : $post->title;
        
        $image = $request->file('image');

        if ( $image ){
            $path = Storage::disk('s3')->putFile('/photo', $request->file('image'));
            $post->image = Storage::disk('s3')->url($path);
        } else {
            
        }
        $post->content = $request->input('content')? $request->input('content') : $post->content;
        try {
        $post->update();
        } catch (\Exception $e){
            return back()->with('message', '更新に失敗しました。');
        }
        return to_route('posts.index')->with('message', '投稿を編集しました。');
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

        return to_route('posts.index')->with('message','投稿を削除しました。');
    }

    public function ikitai($id)
    {
        if(Ikitai::where('post_id', $id)->where('user_id', Auth::id())->exists()) {
            $ikitai = Ikitai::where('post_id', $id)->where('user_id', Auth::id())->first();
            $ikitai->delete();
            return "いきたい削除";
        } else {
            $ikitai_data = new Ikitai();
            $ikitai_data->post_id = $id;
            $ikitai_data->user_id = Auth::id();    
            $ikitai_data->save();
            return "いきたい登録";
        }
    }

    public function empathy($id)
    {
        if(Empathy::where('post_id', $id)->where('user_id', Auth::id())->exists()) {
            $empathy = Empathy::where('post_id', $id)->where('user_id', Auth::id())->first();
            $empathy->delete();
            return "共感削除";
        } else {
            $empathy_data = new Empathy();
            $empathy_data->post_id = $id;
            $empathy_data->user_id = Auth::id();
            $empathy_data->save();
            return "共感登録";
        }
    }
}
