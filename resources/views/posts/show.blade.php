@extends('layouts.app')

@section('content')
<div class="container mb-3">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 col-11 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10 col-11 fs-5 mt-1"> 
            <a href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><a class="mt-1" href="{{ route('posts.index') }}">投稿一覧</a><span class="ms-2 me-1">></span><span>投稿詳細</span>
        </div>
        <h1 class="display-3 ps-1 col-md-10 col-11">投稿詳細 </h1>
    </div>
    <div class="d-flex align-items-center justify-content-center row mb-5">
        <div class="card col-md-10 col-11 mb-3">
            <div class="card-body pb-0">
                <div class="row d-flex justify-content-between">
                    <a class="col-md-10 col-10 fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</a>
                    @if($user->id == $post->user_id)
                    <div class="dropdown col-md-2 col-2">
                        <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none float-end menu-icon" id="dropdownpostMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownpostMenuLink">
                            <li><a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">編集</a></li>

                            <div class="dropdown-divider"></div>

                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-post-modal">削除</a></li>
                        </ul>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="{{ $post->id }}">

                                <!-- 投稿削除モーダル-->
                                @include('modals.delete_post_modal')
                                
                            </form>                                                                        
                        </ul>
                    </div>
                    @endif
                </div>
                <hr>
                <p class="mb-0"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                <h1 class="card-title fs-1" id="{{ $post->id }}"><span class="">{{ $post->title }}</span></h1>
                @if($post->image)
                    <img src="{{ $post->image }}" class="img-fluid w-100"  alt="投稿画像">
                    <br>
                @endif
                <p class="content mt-2 fs-5">{{ $post->content }}</p>
                <p> {{ $post->updated_at}}<p>
            
                <hr>

                <div class="row mb-2">
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{ $post->id }}" class="post-btn ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{ $posts_array[$post->id]['ikitai-icon'] }} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">                    
                        <button data-value="{{ $post->id }}" class="post-btn empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">
                        <a data-bs-toggle="modal" data-bs-target="#report-post-modal" class="post-btn btn btn-danger fs-4 w-75"><i class="fa-solid fa-bell me-1"></i><span class="ms-2 fs-5 align-middle">投稿を報告</span></a>
                    </div>
                </div>
                <!-- 投稿報告フォーム-->
                <form method="POST" action="{{ route('post_report.store') }}">
                    @csrf
                    <!-- 投稿報告のモーダル-->
                    @include('modals.report_post_modal')
                </form>  

                <hr>

                <div>
                    <h1 class="comment-title" id="comment">◎みんなのコメント （{{$post->comments->count()}}件）</h1>
                    <p class="page-number align-middle mb-0 col-md-10">< 全{{$comments->lastPage()}}ページ中： <span class="fs-1 fw-bold">{{$comments->currentPage()}}</span> ページ目  ></p>
                    <div class="row">
                        @foreach($comments as $comment)
                        <div class="col-md-11 col-11 mt-3 ms-3 pt-4 ps-3 border border-2 border- rounded-3">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-11 col-10">
                                    <p class="h3">{{$comment->content}}</p>
                                </div>
                                @if($comment->user_id == Auth::user()->id)
                                <div class="dropdown col-md-1 col-1">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none float-end menu-icon" id="dropdownpostMenuLink{{$comment->id}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownpostMenuLink{{$comment->id}}">
                                        <li><a data-bs-toggle="modal" href="#" data-bs-target="#edit-comment-modal{{$comment->id}}" class="dropdown-item">編集</a></li>
                                          

                                        <div class="dropdown-divider"></div>

                                        <li><a data-bs-toggle="modal" href="#" data-bs-target="#delete-comment-modal{{$comment->id}}" class="dropdown-item">削除</a></li>
                                    </ul>
                                    
                                    <!-- comment編集フォーム-->
                                    <form method="POST" action="{{ route('comment.update', $comment) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <!-- comment編集用のモーダル-->
                                        @include('modals.edit_comment_modal')
                                    </form>  

                                    <!-- コメント削除フォーム-->
                                    <form action="{{ route('comment.destroy', $comment )}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!-- コメント削除用モーダル-->
                                        @include('modals.delete_comment_modal')
                                    </form>  

                                </div>
                                @else 
                                <div class="dropdown col-md-1 col-1">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none float-end menu-icon" id="dropdownreportMenuLink{{$comment->id}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownreportMenuLink{{$comment->id}}">
                                        <li><a data-bs-toggle="modal" href="#" data-bs-target="#report-comment-modal{{$comment->id}}" class="dropdown-item">報告</a></li>
                                    </ul>
                                    <!-- コメント報告用フォーム-->
                                    <form method="POST" action="{{ route('comment_report.store') }}">
                                        @csrf
                                        <!-- コメント報告のモーダル-->
                                        @include('modals.report_comment_modal')
                                    </form>  

                                </div>
                                @endif
                                <label class="fs-5 d-md-block d-none fw-normal">{{$comment->updated_at}} <i class="fa-solid fa-circle-user ms-2 me-1"></i>{{$comment->user->name}}</label>
                                <label class="fs-5 d-md-none d-block fw-normal"><i class="fa-solid fa-circle-user"></i>{{$comment->user->name}}<br>{{$comment->updated_at}}</label>
                            </div>
                        </div>
                        @endforeach
                        <div class="ms-2 mt-2">
                            {{ $comments->links() }}
                        </div>
                    </div>
        
                    @auth
                    <div class="row">
                        <div class="col-md-11 col-12">
                            <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <h1>◎コメントを追加する</h1>
                                <textarea name="content" rows="5" class="comment form-control @error('content') is-invalid @enderror mt-3 pt-2 ps-3" placeholder="この投稿を見ていかせていただきました。本当にありがとうございました。"></textarea>
                                @error('content') 
                                    <strong class="invalid-feedback ms-4 fs-5">コメントを入力してください</strong>
                                @enderror
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <button type="submit" class="btn btn-primary m-3">コメントを追加</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection