@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="fs-1 mb-0">投稿の編集</h1>

            <div>
                <a href="{{ route('posts.index') }}">>投稿一覧にもどる</a>
            </div>
                
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="prefecture_id" class="col-md-12 fs-4">都道府県<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select class="col-md-12 p-2 border rounded" name="prefecture_id" id="prefecture_id">
                                @foreach($prefectures as $pref)
                                    @if($pref->id == $post->prefecture_id)
                                    <option value="{{ $pref->id }}" selected>{{ $pref->name }} </option>
                                    @else
                                    <option value="{{ $pref->id }}">{{ $pref->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="city" class="cpl-md-12 fs-4">市町村<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select name="city" class="col-md-12 p-2 border rounded" id="city">
                                <option value="{{ $post->city }}">{{ $post->city }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="shop_name" class="fs-4">店舗名<span class="osusumeshi-posts-input-label">必須</span></label>
                    <input type="text" name="shop_name" id="shop_name" value="{{ $post->shop_name }}" class="form-control @error('shop_name') is-invalid @enderror">
                    @error('shop_name')
                        @foreach($errors->get('shop_name') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="title" class="fs-4">タイトル<span class="osusumeshi-posts-input-label">必須</span></label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        @foreach($errors->get('title') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>


                <div class="form-group mb-2">
                    <label for="img_preview" class="fs-4">プレビュー</label><br>
                    @if($post->image)
                    <img class="img_preview img-thumbnail img_container" src="{{ $post->image }}" alt="投稿画像">
                    @else
                    <img class="img_preview img-thumbnail img_container" src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/noimage.png" alt="投稿なし">
                    @endif
                </div>

                <!-- 既存の画像を消す-->
                <input type="hidden" name="image_delete" id="image_delete" value="{{ $post->image }}" class="form-control @error('file') is-invalid @enderror">

                <div class="form-group mb-2">
                    <label for="image" class="fs-4">画像</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('file')
                        @foreach($errors->get('file') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="content" class="fs-4">おすすめ内容<span class="osusumeshi-posts-input-label">必須</span></label>
                    <textarea name="content" id="content" rows="13" class="form-control @error('content') is-invalid @enderror"> {{ $post->content }}</textarea>
                    @error('content')
                        @foreach($errors->get('content') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary col-md-3 mb-3">
                    投稿する
                    </button>
                </div>
            
            </form>
        </div>
    </div>
</div>
@endsection