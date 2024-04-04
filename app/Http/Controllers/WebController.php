<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Ikitai;
use App\Models\Empathy;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class WebController extends Controller
{
    public function index()
    {
        $recommend_posts = Post::withCount('ikitais')->orderBy('ikitais_count', 'desc')->take(3)->get();

        foreach($recommend_posts as $recommend_post){
            if(Ikitai::where('post_id', $recommend_post->id)->where('user_id', Auth::id())->exists()){
                $recommend_posts_array["$recommend_post->id"] = [
                    'ikitai-label'=>'解除',
                    'ikitai-icon' =>'solid',
                    'ikitai-btn' =>'info',
                    ];
            }   else{
                $recommend_posts_array["$recommend_post->id"] = [
                    'ikitai-label'=>'行きたい',
                    'ikitai-icon' =>'regular',
                    'ikitai-btn' =>'outline-info',
                ];
            };

            if(Empathy::where('post_id', $recommend_post->id)->where('user_id', Auth::id())->exists()){
                $recommend_posts_array["$recommend_post->id"] +=[
                    'empathy-label'=>'解除',
                    'empathy-icon' =>'solid',
                    'empathy-btn' => 'info',
                ];
            }   else{
                $recommend_posts_array["$recommend_post->id"] += [
                    'empathy-label'=>'行きたい',
                    'empathy-icon' =>'regular',
                    'empathy-btn' => 'outline-info',
                ];
            };
        }

        $new_posts = Post::latest('updated_at')->take(3)->get();
        foreach($new_posts as $new_post){
            if(Ikitai::where('post_id', $new_post->id)->where('user_id', Auth::id())->exists()){
                $posts_array["$new_post->id"] = [
                    'ikitai-label'=>'解除',
                    'ikitai-icon' =>'solid',
                    'ikitai-btn' =>'info',
                    ];
            }   else{
                $posts_array["$new_post->id"] = [
                    'ikitai-label'=>'行きたい',
                    'ikitai-icon' =>'regular',
                    'ikitai-btn' =>'outline-info',
                ];
            };

            if(Empathy::where('post_id', $new_post->id)->where('user_id', Auth::id())->exists()){
                $posts_array["$new_post->id"] +=[
                    'empathy-label'=>'解除',
                    'empathy-icon' =>'solid',
                    'empathy-btn' => 'info',
                ];
            }   else{
                $posts_array["$new_post->id"] += [
                    'empathy-label'=>'行きたい',
                    'empathy-icon' =>'regular',
                    'empathy-btn' => 'outline-info',
                ];
            };
        }


        return view('web.index', compact('new_posts','posts_array', 'recommend_posts','recommend_posts_array'));
    }
}
