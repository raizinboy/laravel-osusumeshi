@extends('layouts.app')
 
@section('content')
<div class="container mb-5">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
    <div class="d-flex justify-content-center row">
        <div class="row col-md-10 col-10 mb-3 ps-0 pe-0">
            <div class="mt-1 mb-2 fs-5">
                <a class="mt-1" href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><span>{{ $user->name }}のページ</span>
            </div>
            <h1 class="display-3 ps-1 col-md-10"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}のページ</h1>
            <div class="card profile-card">
                <div class="row d-flex justify-content-between">
                    <h1 class="col-md-8 mt-3 ms-3 fs-1"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}</h1>
                    @if($user->id == Auth::user()->id)
                    <div class="col-md-3 d-flex justify-content-center align-items-center">
                        @if(isset( $user->profile->user_id))
                            <a data-bs-toggle="modal" data-bs-target="#update-profile-modal"class="h-50 btn btn-success">プロフィールの編集</a>
                        @else
                            <a data-bs-toggle="modal" data-bs-target="#create-profile-modal"class="h-50 btn btn-success">プロフィールの編集</a>
                        @endif
                        
                        <form method="POST" action="{{ route('profile.create') }}">
                            @csrf
                            <!-- profile作成用のモーダル-->
                            <div class="modal fade" id="create-profile-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createProfileLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-between">
                                            <label class="modal-title ms-1 fs-3" id="createProfileLabel">プロフィールを編集</label>
                                            <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="content" class="fs-4">＜自己紹介＞</label>
                                            <textarea name="content" rows="7" class="form-control @error('content') is-invalid @enderror" placeholder="aaaaa"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                            <button type="submit" class="btn btn-primary me-3">保存</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>  

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <!-- profile更新用のモーダル-->
                            <div class="modal fade" id="update-profile-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="updateProfileLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-between">
                                            <label class="modal-title ms-1 fs-3" id="updateProfileLabel">プロフィールを編集</label>
                                            <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="content" class="fs-4">＜自己紹介＞</label>
                                            <textarea name="content" rows="7" class="form-control @error('content') is-invalid @enderror" placeholder="aaaaa">@if(isset($user->profile->content)){{$user->profile->content}}@endif</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                            <button type="submit" class="btn btn-primary me-3">保存</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>  
                    </div>
                    @endif
                </div>
                <div class="card-body pt-0 pb-0">
                    <h5 class="card-title fs-3">＜自己紹介＞</h5>
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
                <h1 class="display-5 col-md-12 col-12 mt-3"><i class="fa-solid fa-circle-user me-2"></i>{{$user->name}}の投稿（全{{$posts_count}}件）</h1>
                <p class="fs-4 align-middle mb-0 col-md-10">< 全{{$posts->lastPage()}}ページ中： <span class="fs-1 fw-bold">{{$posts->currentPage()}}</span> ページ目  ></p>
            </div>
        </div>
        @foreach($posts as $post)
        <div class="card col-md-10 mb-3">
            <div class="card-body pb-0">
                <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                <hr>    
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                
                    <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                    <h1 class="fs-1 fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                    @if($post->image !== '')
                        <img src="{{ asset('storage/photos/' . $post->image) }}" class="img-fluid w-100"  alt="投稿画像">
                        <br>
                    @endif
                    <p class="content mt-3 fs-5">{{ $post->content }}</p>
                    <p> {{ $post->updated_at}}<p>
                    <hr>
                </a>
                <div class="row mb-3">
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{$post->id}}" class="ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{$posts_array[$post->id]['ikitai-icon']}} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                    </div>
                    
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{$post->id}}" class="empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">
                        <a href="/laravel-osusumeshi/public/posts/{{$post->id}}#comment" class="btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row col-md-10 col-10">
            {{ $posts->links() }}
        </div>
    </div>
</div>
 @endsection