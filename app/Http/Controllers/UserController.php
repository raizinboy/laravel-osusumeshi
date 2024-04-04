<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Ikitai;
use App\Models\Empathy;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage($id)
    {
        $user = User::where('id', $id)->first();
        $posts_count = Post::where('user_id', $id)->count();
        $posts = Post::where('user_id', $id)->paginate(4);

        $posts_array = array();

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
                    'empathy-btn' =>'info',
                ];
            }   else{
                $posts_array["$post->id"] += [
                        'empathy-label'=>'共感',
                        'empathy-icon' =>'regular',
                        'empathy-btn' =>'outline-info',
                ];
            };
        }

        $profile = "";

        return view('users.mypage',compact('user', 'posts', 'posts_array', 'posts_count', 'profile'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = Auth::user();

        //inputに入力があったら入力内容をアップデートする。
        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') :$user->email;
        try {
            $user->update();
        } catch (\Exception $e) {
            return back()->with('message', '更新に失敗しました。');
        } 
        
        return to_route('mypage', Auth::id())->with('message', '会員情報を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Auth::user()->forceDelete();
        return redirect('/home');
    }

    public function update_password(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:8|max:255',
        ]);

        $user = Auth::user();

        if($request->input('password') == $request->input('password_confirmation')){
            $user->password = bcrypt($request->input('password'));
            try {
                $user->update();
            } catch (\Exception $e) {
                return back()-with('message', '更新に失敗しました。');
            }
        } else {
            return to_route('mypage.edit_password');
        }

        return to_route('mypage',Auth::id())->with('message', 'パスワードを変更しました。');
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function show_ikitai()
    {
        $ikitai_post_ids = Auth::user()->ikitais()->pluck('post_id')->toArray();

        $posts = Post::whereIn('id', $ikitai_post_ids)->paginate(3);

        $posts_array = array();

        foreach($posts as $post) {
            $posts_array["$post->id"] = [
                'ikitai-label'=>'解除',
                'ikitai-icon' =>'solid',
                'ikitai-btn' =>'info',
                ];

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

        return view('users.show_ikitai',compact('posts', 'posts_array'));
    }

    public function show_empathy()
    {
        $empathy_post_ids = Auth::user()->empathies()->pluck('post_id');

        $posts = Post::whereIn('id', $empathy_post_ids)->paginate(3);

        $posts_array = array();

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

            $posts_array["$post->id"] += [
                    'empathy-label'=>'解除',
                    'empathy-icon' =>'solid',
                    'empathy-btn' => 'info',
            ];
        };

        return view('users.show_empathy', compact('posts', 'posts_array'));
    }
}
