@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="fs-1 mb-0">投稿の編集</h1>

            <div>
                <a href="{{ route('posts.index') }}">>投稿一覧にもどる</a>
            </div>
                
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <!--
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="prefecture_id" class="col-md-12 fs-4">都道府県</label>
                            <select class="col-md-12 p-2 border rounded" name="prefecture_id" id="prefecture_id">
                                @foreach($prefectures as $pref)
                                <option value="{{ $pref->id }}">{{ $pref->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="city" class="cpl-md-12 fs-4">市町村</label>
                            <select name="city" class="col-md-12 p-2 border rounded" id="city">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                -->
                <div class="form-group mb-2">
                    <label for="shop_name" class="fs-4">店舗名</label>
                    <input type="text" name="shop_name" id="shop_name" value="{{ $post->shop_name }}" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="title" class="fs-4">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control">
                </div>

                <!-- 既存の画像を消す-->
                <input type="hidden" name="image_delete" id="image_delete" value="{{ $post->image }}" class="form-control">

                <div class="form-group mb-2">
                    <label for="image" class="fs-4">画像</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="content" class="fs-4">内容</label>
                    <textarea name="content" id="content" rows="13" class="form-control"> {{ $post->content }}</textarea>
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