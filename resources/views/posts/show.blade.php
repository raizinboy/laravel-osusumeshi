@extends('layouts.app')

@section('content')
<div class="container mb-3">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10 fs-5 mt-1"> 
            <a href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><a class="mt-1" href="{{ route('posts.index') }}">投稿一覧</a><span class="ms-2 me-1">></span><span>投稿詳細</span>
        </div>
        <h1 class="display-3 ps-1 col-md-10">投稿詳細 </h1>
    </div>
    <div class="d-flex align-items-center justify-content-center row mb-5">
        <div class="card col-md-10 mb-3">
            <div class="card-body pb-0">
                <div class="row d-flex justify-content-between">
                    <a class="col-md-3 fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                    @if($user->id == $post->user_id)
                    <div class="dropdown col-md-2">
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
                                <div class="modal fade" id="delete-post-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-between">
                                                <h5 class="modal-title ms-1 fs-3" id="deletePostLabel"><label>本当に投稿を削除しますか？</label></h5>
                                                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fs-5 text-center">一度投稿を削除するとを復元することはできません。</p>
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
                <hr>
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
                    <div class="col-md-4 text-center fs-5">
                        <button data-value="{{ $post->id }}" class="ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{ $posts_array[$post->id]['ikitai-icon'] }} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">                    
                        <button data-value="{{ $post->id }}" class="empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 text-center fs-5">
                        <a data-bs-toggle="modal" data-bs-target="#report-post-modal" class="btn btn-danger fs-4 w-75"><i class="fa-solid fa-bell me-1"></i><span class="ms-2 fs-5 align-middle">投稿を報告</span></a>
                    </div>
                </div>

                <!-- 
                <form method="POST" action="{{ route('post_report.store') }}">
                    @csrf
                    <!-- profile作成用のモーダル-->
                    <div class="modal fade" id="report-post-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="postReportLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <label class="modal-title ms-1 fs-3" id="postReportLabel">この投稿を報告する。</label>
                                    <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="email" class="fs-4">返信可能なメールアドレス<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                                    <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror osusumeshi-login-input" name="email" value="{{ Auth::user()->email }}"" required autocomplete="email" placeholder="osusumeshi@gmail.com">
                                    @error('email')
                                        @foreach($errors->get('email') as $message)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @endforeach
                                    @enderror
                                    <input type="hidden" name="post_id" placeholder="osusumeshi@gmail.com" value="{{$post->id}}">
                                    <label for="category" class="fs-4">報告カテゴリー<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                                    <br>
                                    <select name="category" class="mt-1 mb-1">
                                        <option value='' disabled selected style='display:none;'>選択してください</option>
                                        <option value="誹謗・中傷">誹謗・中傷</option>
                                        <option value="店舗へのいやがらせ">店舗への嫌がらせ</option>
                                        <option value="不適切な言葉遣い">不適切な言葉遣い</option>
                                        <option value="不適切な画像">不適切な画像</option>
                                        <option value="プライバシーの侵害">プライバシーの侵害</option>
                                        <option value="その他">その他</option>
                                    </select>
                                    <br>
                                    <label for="content" class="fs-4">報告内容<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                                    <textarea name="content" rows="7" class="form-control @error('content') is-invalid @enderror" placeholder="aaaaa"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn btn-primary me-3">送信</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>  

                <hr>

                <div>
                    <h1 id="comment">◎みんなのコメント （{{$post->comments->count()}}件）</h1>
                    <p class="fs-4 align-middle mb-0 col-md-10">< 全{{$comments->lastPage()}}ページ中： <span class="fs-1 fw-bold">{{$comments->currentPage()}}</span> ページ目  ></p>
                    <div class="row">
                        @foreach($comments as $comment)
                        <div class="col-md-11 mt-3 ms-3 pt-4 ps-3 border border-2 border- rounded-3">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-11">
                                    <p class="h3">{{$comment->content}}</p>
                                </div>
                                @if($comment->user_id == Auth::user()->id)
                                <div class="dropdown col-md-1">
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
                                        <div class="modal fade" id="edit-comment-modal{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editCommentLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-between">
                                                        <label class="modal-title ms-1 fs-3" id="editCommentLabel">コメントを編集する</label>
                                                        <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="content" class="fs-4"><コメント></label>
                                                        <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ $comment->content }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                                                        <button type="submit" class="btn btn-primary me-3">保存</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>  

                                    <!-- コメント削除フォーム-->
                                    <form action="{{ route('comment.destroy', $comment )}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!-- コメント削除用モーダル-->
                                        <div class="modal fade" id="delete-comment-modal{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteCommentLabel{{$comment->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-between">
                                                        <h5 class="modal-title ms-1 fs-3" id="deleteCommentLabel{{ $comment->id }}"><label>本当にコメントを削除しますか？</label></h5>
                                                        <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="fs-5 text-center">一度コメントを削除すると復元することはできません。</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                                                        <button type="submit" class="btn btn-danger me-3">コメントを削除する</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>  

                                </div>
                                @endif
                                <label class="fs-5 fw-normal">{{$comment->updated_at}} <i class="fa-solid fa-circle-user ms-2 me-1"></i>{{$comment->user->name}}</label>
                            </div>
                        </div>
                        @endforeach
                        <div class="ms-2 mt-2">
                            {{ $comments->links() }}
                        </div>
                    </div>
        
                    @auth
                    <div class="row">
                        <div class="col-md-11">
                            <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <h1>◎コメントを追加する</h1>
                                <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror mt-3 ms-3 pt-2 ps-3"></textarea>
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