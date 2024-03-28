@extends('layouts.app')

@section('content')
<div class="container mb-3">
    @if($message != "")
    <div class="row justify-content-center">
        <div class="col-md-10 alert alert-light p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ $message }}</div>
    </div>
    @endif
    <div class="row justify-content-center">
        <h1 class="display-3 ps-1 pt-2 col-md-10">投稿一覧 </h1>
    </div>
    <div class="d-flex align-items-center justify-content-center row">
        @foreach($posts as $post)
        <div class="card col-md-10 mb-3">
            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
            <div class="card-body pb-0">
                <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                <hr>    
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                
                    <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-4 fw-bold">{{ $post->shop_name }}</span></p>
                    <h1 class="fs-1 fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                    @if($post->image !== '')
                        <img src="{{ asset('storage/photos/' . $post->image) }}" class="img-fluid w-100"  alt="投稿画像">
                        <br>
                    @endif
                    <p class="content mt-3 fs-5">{{ $post->content }}</p>
                    <p> {{ $post->updated_at}}<p>
                    <hr>
                </a>
                <div class="row mb-2">
                    <div class="col-md-3 text-center fs-5">
                        @if($post->is_ikitaied_by_auth_user())
                        <a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="text-decoration-none btn btn-info fs-4"><i class="fa-solid fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">解除</span></a>
                        @else
                        <a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="text-decoration-none btn btn-info fs-4"><i class="fa-regular fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">行きたい</span></a>
                        @endif
                    </div>
                    
                    <div class="col-md-3 text-center fs-5">
                        @if($post->is_empathized_by_auth_user())
                        <a href="{{ route('posts.empathy',$post->id) }}" id="empathy-btn{{$post->id}}" class=" text-decoration-none btn btn-info fs-4"><i class="fa-solid fa-hand me-1"></i>{{ $post->empathies->count() }}<span class="ms-2 fs-6 align-middle">解除</span></a>
                        @else
                        <a href="{{ route('posts.empathy',$post->id) }}" id="empathy-btn{{$post->id}}" class=" text-decoration-none btn btn-info fs-4"><i class="fa-regular fa-hand me-1"></i>{{ $post->empathies->count() }}<span class="ms-2 fs-6 align-middle">共感</span></a>
                        @endif
                    </div>
                    <div class="col-md-3 text-center fs-5">
                        <a href="#"><i class="fa-solid fa-bell me-1"></i>報告
                        </a>
                    </div>
                    <div class="col-md-3 text-center fs-5">
                        <a href="#"><i class="fa-solid fa-comment me-1"></i>コメント
                        </i></a>
                    </div>
                </div>
                <a id="post-create-btn" href="{{ route('posts.create') }}">新規作成</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection