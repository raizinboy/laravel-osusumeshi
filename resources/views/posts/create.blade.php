@extends('layouts.app')

@section('content')
<div class="container mb-5">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
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
                            <label for="prefecture_id" class="col-md-12 col-12 fs-4">都道府県<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select class="col-md-12 col-12 p-2 border rounded" name="prefecture_id" id="prefecture_id">
                                @foreach($prefectures as $pref)
                                <option value="{{ $pref->id }}">{{ $pref->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="city" class="cpl-md-12 col-12 fs-4">市町村<span class="osusumeshi-posts-input-label">必須</span></label>
                            <select name="city" data-create="create" class="col-md-12 col-12 p-2 border rounded @error('city') is-invalid @enderror"" id="city">
                            </select>
                            @error('city')
                                @foreach($errors->get('city') as $message)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @endforeach
                            @enderror
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
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="のんびり過ごすのに最適です。">
                    @error('title')
                        @foreach($errors->get('title') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <h5 class="fs-4 fw-bold">プレビュー</h5>
                    <img class="img_preview img-thumbnail img_container" src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/noimage.png">
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
                    <label for="content" class="fs-4">おすすめ内容<span class="osusumeshi-posts-input-label">必須</label>
                    <textarea name="content" id="content" rows="13" class="form-control @error('content') is-invalid @enderror" placeholder="築80年の古民家を利用した店内では、ゆったりとした時間が過ごすことができ休日にピッタリのお店です。オーナーが作る和食もおいしく、地元で取れた肉や野菜を使っているそうです。この地域に訪れたら、ぜひとも寄ってほしいお店です。機会がありましたら行ってみてください。">{{ old('content')}}</textarea>
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