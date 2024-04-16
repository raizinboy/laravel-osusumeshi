@extends('layouts.app')

@section('content')
<div class="container mb-5">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10 fs-5 mt-1">
            <a href="{{ route('top') }}">TOP</a><span class="ms-2 me-1">></span><span>投稿一覧</span>
        </div>
        <h1 class="display-3 ps-1 col-md-10 col-10">投稿一覧 </h1>
        <div class="search-text-wrap col-md-10">
            @if($prefecture)
            <h3 class="search-text ms-1 mb-0"><span class="fw-bold">{{$prefecture->name}} </span></h3>
            @endif

            @if($city)
            <h3 class="search-text ms-1 mb-0">><span class="fw-bold ps-1">「{{$city}} 」の</span></h3>
            @endif

            @if($shop_name)
            <h3 class="search-text ms-1 mb-0">><span class="fw-bold ps-1">店名「{{$shop_name}}」を含む</span></h3>
            @endif
            <h3 class="search-text ms-1 mb-0">><span class="fw-bold ps-1">投稿一覧</span><span class="fw-bold h2 ps-1">{{$total_count}}</span>件</h3>
        </div>
        <div class="col-md-10 col-12">
            <form class="row g-1" action="{{ route('posts.index') }}" method="GET">
                <div class="col-md-3 col-12">
                    <select name="prefecture_id" id="prefecture_id_search" class="col-md-12 col-12 border rounded p-2" placeholder="都道府県">
                            <option value="">都道府県（選択なし）</option>
                            @foreach($prefectures as $pref) 
                                @if ($prefecture && $pref->id == $prefecture->id)
                                    <option value="{{ $pref->id }}" selected>{{$pref->name}}</option>
                                @else
                                    <option value="{{ $pref->id }}">{{$pref->name}}</option>
                                @endif  
                            @endforeach
                    </select>
                </div>   
                <div class="col-md-3 col-12">
                    <select name="city" class="col-md-12 col-12 p-2 border rounded @error('city') is-invalid @enderror"" id="city">

                        @if($city)
                        <option value="{{$city}}" selected>{{$city}}</option>
                        @else
                        <option value="">市町村（選択なし）</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <input name="shop_name" type="text" class="col-md-12 col-12 border rounded p-2" placeholder="店舗名" value="{{ $shop_name }}"> 
                </div>
                <div class="search-btn-wrap row col-md-3 col-12">
                    <div class="row col-md-3 col-12 mx-0 ps-1 pe-1">
                        <button type="submit" class="search-btn col-12 btn bg-success bg-opacity-50"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-10 col-11 d-flex mt-2 order_label">
            <div class="me-2 fw-bold">並び替え：</div>
            <div class="me-3">@sortablelink('ikitais_count', '行きたい数')</div>
            <div class="me-3">@sortablelink('empathies_count', '共感数')</div>
            <div>@sortablelink('updated_at', '新着順')</div>
        </div>

        <p class="page-number align-middle mb-0 col-md-10 col-10">< 全{{$posts->lastPage()}}ページ中： <span class="fs-1 fw-bold">{{$posts->currentPage()}}</span> ページ目  ></p>
    </div>
    <div class="d-flex align-items-center justify-content-center row">
        @foreach($posts as $post)
        <div class="card col-md-10 col-11 mb-3">
            <div class="card-body pb-0">
                <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                <hr>    
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                
                    <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $post->shop_name }}</span></p>
                    <h1 class="post-title fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                    @if($post->image)
                        <img src="{{ $post->image }}" class="img-fluid w-100"  alt="投稿画像">
                        <br>
                    @endif
                    <p class="index-content mt-3 fs-5">{{ $post->content }}</p>
                    <p> {{ $post->updated_at}}<p>
                    <hr>
                </a>
                <div class="row mb-3">
                    <div class="col-md-4 col-12 text-center fs-5">
                        <button data-value="{{$post->id}}" class="post-btn ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{$posts_array[$post->id]['ikitai-icon']}} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                    </div>
                    
                    <div class="col-md-4 col-12 text-center fs-5">
                        <button data-value="{{$post->id}}" class="post-btn empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-5 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                    </div>

                    <div class="col-md-4 col-12 text-center fs-5">
                        <a href="/posts/{{$post->id}}#comment" class="post-btn btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-10">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
    <div class="row text-center">
        <a id="post-create-btn" class="col-md-2" href="{{ route('posts.create') }}">+</a>
    </div>
</div>
@endsection