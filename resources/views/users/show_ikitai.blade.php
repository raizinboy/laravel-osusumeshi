@extends('layouts.app')

@section('content')
<div class="container mb-5">
    @if(isset($message))
    <div class="row justify-content-center">
        <div class="col-md-10 col-10 alert alert-light p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ $message }}</div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10 col-12 fs-5 mt-1 mb-2">
            <a href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><a class="mt-1" href="{{ route('mypage', Auth::user()->id) }}">マイページ</a><span class="ms-2 me-1">></span><span>行きたい投稿一覧</span>
        </div>
        <h1 class="display-3 ps-1 ms-3 col-md-10 d-none d-md-block"><span class="fs-2 mb-3 me-1">{{ Auth::user()->name }}さんの</span>行きたい投稿一覧 </h1>
        <h2 class="ps-1 ms-3 col-12 d-md-none d-block">{{ Auth::user()->name }}さんの</h2>
        <h2 class="ms-5 col-12 d-md-none d-block"> 行きたい投稿一覧 </h2>
        <p class="fs-4 align-middle mb-0 col-md-10 col-11">< 全{{$posts->lastPage()}}ページ中： <span class="fs-1 fw-bold">{{$posts->currentPage()}}</span> ページ目  ></p>
    </div>
    <div class="d-flex align-items-center justify-content-center row">
        @foreach($posts as $post)
        <div class="card col-md-10 col-11 mb-3">
            <div class="card-body pb-0">
                <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                <hr>    
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                
                    <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                    <h1 class="post-title fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                    @if($post->image !== '')
                        <img src="{{ asset('storage/photos/' . $post->image) }}" class="img-fluid w-100"  alt="投稿画像">
                        <br>
                    @endif
                    <p class="index-content content mt-3 fs-5">{{ $post->content }}</p>
                    <p> {{ $post->updated_at}}<p>
                    <hr>
                </a>
                <div class="row mb-3">
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{$post->id}}" class="post-btn ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{$posts_array[$post->id]['ikitai-icon']}} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                    </div>
                    
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{$post->id}}" class="post-btn empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">
                        <a href="/laravel-osusumeshi/public/posts/{{$post->id}}#comment" class="post-btn btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection