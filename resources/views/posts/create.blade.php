@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="fs-1 mb-0">新規投稿</h1>

            <div>
                <a href="{{ route('posts.index') }}">>投稿一覧にもどる</a>
            </div>
                
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="prefecture_id" class="col-md-12 fs-4">都道府県<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select class="col-md-12 p-2 border rounded" name="prefecture_id" id="prefecture_id">
                                @foreach($prefectures as $pref)
                                <option value="{{ $pref->id }}">{{ $pref->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="city" class="cpl-md-12 fs-4">市町村<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select name="city" class="col-md-12 p-2 border rounded" id="city">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <div class="form-group mb-2">
                    <label for="shop_name" class="fs-4">店舗名<span class="osusumeshi-posts-input-label">必須</span></label>
                    <input type="text" name="shop_name" id="shop_name" value="{{ old('shop_name') }}" class="form-control @error('shop_name') is-invalid @enderror" placeholder="おすすめし店">
                    @error('shop_name')
                        @foreach($errors->get('shop_name') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>
                    
                <div class="form-group mb-2">
                    <label for="title" class="fs-4">タイトル<span class="osusumeshi-posts-input-label">必須</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="最高でした。">
                    @error('title')
                        @foreach($errors->get('title') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="image" class="fs-4">画像</label>
                    <input type="file" name="image" id="image" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        @foreach($errors->get('file') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="content" class="fs-4">内容<span class="osusumeshi-posts-input-label">必須</label>
                    <textarea name="content" id="content" rows="13" class="form-control @error('content') is-invalid @enderror" placeholder="aaaa">{{ old('content')}}</textarea>
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