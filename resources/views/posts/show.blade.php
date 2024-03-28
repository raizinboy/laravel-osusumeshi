@extends('layouts.app')

@section('content')
<div class="container mb-3">
    <div class="row justify-content-center">
        <h1 class="display-3 ps-1 pt-2 col-md-10">投稿詳細 </h1>
    </div>
    <div class="d-flex align-items-center justify-content-center row mb-5">
        <div class="card col-md-10 mb-3">
            <div class="card-body pb-0">
                <div class="row d-flex justify-content-between" id="post">
                    <h3 class="col-md-3 fs-4"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                    @if($user->id == $post->user_id)
                    <div class="dropdown col-md-2">
                        <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none float-end menu-icon" id="dropdownpostMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">︙</a>
                        <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownpostMenuLink">
                            <li><a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">編集</a></li>

                            <div class="dropdown-divider"></div>

                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-post-modal">削除</a></li>
                        </ul>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{{ $post->id }}">

                            <!-- 投稿削除モーダル-->
                            <div class="modal fade" id="delete-post-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deletePostsLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-between">
                                            <h5 class="modal-title ms-1 fs-3 id="deletePostsLabel"><label>本当に投稿を削除しますか？</label></h5>
                                            <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="fs-5 text-center">一度削除するとを復元することはできません。</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                            <button type="submit" class="btn btn-danger me-3">投稿を削除する</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>                                                                        
                        </ul>
                    </div>
                    @endif
                </div>
                <p class="mb-0"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                <h1 class="card-title fs-1" id="{{ $post->id }}"><span class="">{{ $post->title }}</span></h1>
                @if($post->image !== '')
                    <img src="{{ asset('storage/photos/' . $post->image) }}" class="img-fluid w-100"  alt="投稿画像">
                    <br>
                @endif
                <p class="content mt-2 fs-5">{{ $post->content }}</p>
                <p> {{ $post->updated_at}}<p>
            
                <hr>

                <div class="row mb-2">
                    <div class="update-part col-md-4 text-center fs-5">
                        @if($post->is_ikitaied_by_auth_user())
                        <a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="ikitai-btn text-decoration-none btn btn-info fs-4"><i class="fa-solid fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">解除</span></a>
                        @else
                        <a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="ikitai-btn text-decoration-none btn btn-info fs-4"><i class="fa-regular fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">行きたい</span></a>
                        @endif
                    </div>

                    <div class="update-part col-md-4 text-center fs-5">
                        @if($post->is_empathized_by_auth_user())
                        <a href="{{ route('posts.empathy',$post->id) }}" id="empathy-btn{{$post->id}}" class=" text-decoration-none btn btn-info fs-4"><i class="fa-solid fa-hand me-1"></i>{{ $post->empathies->count() }}<span class="ms-2 fs-6 align-middle">解除</span></a>
                        @else
                        <a href="{{ route('posts.empathy',$post->id) }}" id="empathy-btn{{$post->id}}" class=" text-decoration-none btn btn-info fs-4"><i class="fa-regular fa-hand me-1"></i>{{ $post->empathies->count() }}<span class="ms-2 fs-6 align-middle">共感</span></a>
                        @endif
                    </div>

                    <div class="col-md-4 text-center fs-5">
                        <a href="#"><i class="fa-solid fa-bell me-1"></i>報告
                        </a>
                    </div>
                </div>

                <hr>

                <div>
                    <h1 class="">◎みんなのコメント</h1>
                    <div class="row">
                        @foreach($comments as $comment)
                        <div class="col-md-11 mt-3 ms-3 pt-4 ps-3 border border-2 border- rounded-3">
                            <p class="h3">{{$comment->content}}</p>
                            <label class="fs-5 fw-normal">{{$comment->updated_at}} <i class="fa-solid fa-circle-user ms-2 me-1"></i>{{$comment->user->name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <br>
        
                    @auth
                    <div class="row">
                        <div class="col-md-11">
                            <form method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <h1>◎コメントを追加する</h1>
                                @error('content')
                                    <strong>コメントを入力してください</strong>
                                @enderror
                                <textarea name="content" class="form-control mt-3 ms-3 pt-2 ps-3"></textarea>
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