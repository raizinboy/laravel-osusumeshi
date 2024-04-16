@extends('layouts.app')
 
@section('content')
<div class="container mb-5">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 col-11 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
    <div class="d-flex justify-content-center row">
        <div class="row col-md-10 col-11 mb-1 ps-0 pe-0">
            <div class="mt-2 mb-2 top_label">
                <a class="mt-1" href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><span>{{ $user->name }}のページ</span>
            </div>
            <h1 class="mypage_label col-md-10 col-12"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}のページ</h1>
            <div class="card profile-card">
                <div class="row d-flex justify-content-between">
                    <h1 class="col-md-8 col-11 mt-3 mypage_label2"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}</h1>
                    @if($user->id == Auth::user()->id)
                    <div class="col-md-3 col-12 d-flex justify-content-center align-items-center">
                        @if(isset( $user->profile->user_id))
                            <a data-bs-toggle="modal" data-bs-target="#update-profile-modal"class="profile_btn btn btn-success">プロフィールの編集</a>
                        @else
                            <a data-bs-toggle="modal" data-bs-target="#create-profile-modal"class="profile_btn btn btn-success">プロフィールの編集</a>
                        @endif
                        
                        <form method="POST" action="{{ route('profile.create') }}">
                            @csrf
                            <!-- profile作成用のモーダル-->
                            @include('modals.create_profile_modal')
                        </form>  

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <!-- profile更新用のモーダル-->
                            @include('modals.update_profile_modal')
                        </form>  
                    </div>
                    @endif
                </div>
                <div class="card-body pt-0 pb-0">
                    <h5 class="card-title introduction_title">＜自己紹介＞</h5>
                    <div class="border border-1 h-75">
                        <p class="card-text p-2">
                        @if(isset($user->profile->user_id))
                            {{$user->profile->content}}
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="mypage_label3 col-md-12 col-12 mt-3"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}の投稿 <span class="count_label">（全{{$posts_count}}件）</span></h1>
                <div class="col-md-10 col-11 d-flex mt-2 order_label">
                    <div class="me-2 fw-bold">並び替え：</div>
                    <div>@sortablelink('updated_at', '新着順')</div>
                </div>
                <p class="page-number align-middle mb-0 col-md-12 col-12">< 全{{$posts->lastPage()}}ページ中： <span class="current_page_label fw-bold">{{$posts->currentPage()}}</span> ページ目  ></p>
            </div>
        </div>
        @foreach($posts as $post)
        <div class="card col-md-10 col-11 mb-3">
            <div class="card-body pb-0">
                <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                <hr>    
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                
                    <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                    <h1 class="fs-1 fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                    @if($post->image)
                        <img src="{{ $post->image }}" class="img-fluid w-100"  alt="投稿画像">
                        <br>
                    @endif
                    <p class="content mt-3 fs-5">{{ $post->content }}</p>
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
                        <a href="/posts/{{$post->id}}#comment" class="post-btn btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row col-md-10 col-10">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
 @endsection