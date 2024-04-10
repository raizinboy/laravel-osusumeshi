@extends('layouts.app')
 
 @section('content')
 <div class="row">
    <div class="col-md-12 col-12 carousel-container">
        <div id="carouselExampleDark" class="carousel carousel-fade h-100 w-100" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/top.jpg" class="crousel-img d-block w-100" alt="トップ画像1">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label mb-5">おすすめし</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                    <div class="carousel-caption d-block d-md-none">
                        <h5 class="carousel-label">おすすめし</h5>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/top2.jpg" class="crousel-img d-block w-100" alt="トップ画像2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label mb-5">あなたのおすすめが</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                    <div class="carousel-caption d-block d-md-none">
                        <h5 class="carousel-label">あなたのおすすめが</h5>
                    </div>
                </div>
                
                <div class="carousel-item h-100">
                    <img src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/top1.jpg" class="crousel-img d-block w-100" alt="トップ画像3">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label-2 text-white">みんなのおすすめに！</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                    <div class="carousel-caption d-block d-md-none">
                        <h5 class="carousel-label-2">みんなのおすすめに！</h5>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/top4.edited.jpg" class="crousel-img d-block w-100" alt="トップ画像4">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label-2 text-white mb-5">みんなのおすすめが</h1>
                        <div class="pt-3">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                    <div class="carousel-caption d-block d-md-none">
                        <h5 class="carousel-label-2">みんなのおすすめが</h5>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="https://s3.ap-northeast-1.amazonaws.com/osusumeshi123/top/top3.jpg" class="crousel-img d-block w-100" alt="トップ画像5">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label">あなたのおすすめに！</h1>
                        <div class="mt-5">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                    <div class="carousel-caption d-block d-md-none">
                        <h5 class="carousel-label">あなたのおすすめに！</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="d-flex justify-content-between d-block d-md-none mt-3">
        <div class="">
            <a href="{{ route('posts.create') }}" class="btn btn-success w-100 ms-1 fs-2">投稿作成へ</a>
        </div>
        <div class="">
            <a href="{{ route('posts.index') }}" class="btn btn-danger w-100 me-2 fs-2">投稿一覧へ</a>
        </div>
    </div>
    <section>
        <h2 class="mt-4 display-2 fw-bold">◎使い方ガイド</h1>
        <div class="row">
            <div class="col-md-6 col-12 fs-3 fw-bold">
                <h3 class="col-md-12 col-12 fs-2 ms-3">★お店を紹介する</h3>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use mb-0"><span class="me-1">&#9312;</span><span class="no-hover-btn btn btn-success me-2">投稿作成へ</span>をクリック</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use-2 mb-0"><span class="me-1">&#9313;</span>紹介したいお店のある地域など、<br>必要事項を入力</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use mb-0"><span class="me-1">&#9314;</span>お店のおすすめポイントを「紹介内容」に記載</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use-3 mb-0"><span class="me-1">&#9315;</span><span class="no-hover-btn btn btn-primary me-2">投稿する</span>を押すと投稿一覧に投稿される！</p>
                </div>
            </div>
            <div class="col-md-6 col-12 fs-3 fw-bold">
                <h3 class="col-md-12 col-12 fs-2 ms-3">★お店を探す</h3>
                <div class="row justify-content-center">   
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use mb-0"><span class="me-1">&#9312;</span><span class="no-hover-btn btn btn-danger me-2">投稿一覧へ</span>をクリック</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use-2 mb-0"><span class="me-1">&#9313;</span>必要に応じて、お店を探したい地域や<br>店舗名でしぼり込む</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use-2 mb-0"><span class="me-1">&#9314;</span>行ってみたいと思ったお店は<br><span class="no-hover-btn btn btn-outline-info me-1"><i class="fa-regular fa-face-grimace me-1"></i>行きたい</span>を押してメモしておこう！</p>
                </div>
                <div class="row justify-content-center">
                    <i class="col-md-11 col-11 text-center fa-solid fa-arrow-down mb-0 pt-2 pb-2 fs-1"></i>
                </div>
                <div class="row justify-content-center">    
                    <p class="col-md-11 col-11 text-center border border-3 border-dark rounded how-to-use-2 mb-0"><span class="me-1">&#9315;</span>自分もそう思うと思った投稿には<br><span class="no-hover-btn btn btn-outline-info me-1"><i class="fa-regular fa-hand me-1"></i>共感</span>で信頼性UP!</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="mt-4 display-2 fw-bold">◎人気の投稿</h2>
        <div class="d-flex align-items-center justify-content-center row">
            @foreach($recommend_posts as $recommend_post)
            <div class="card col-md-9 col-11 mb-3">
                <div class="card-body pb-0">
                    <a class="fs-3 text-decoration-none" href="{{route('mypage',$recommend_post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $recommend_post->user->name }}</h3>
                    <hr>    
                    <a href="{{ route('posts.show', $recommend_post->id) }}" class="text-decoration-none text-dark">
                    
                        <p class="mb-1"><span class="me-1">{{ $recommend_post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $recommend_post->city }}</span>><span class="ms-1 fs-3 fw-bold">{{ $recommend_post->shop_name }}</span></p>
                        <h1 class="post-title fw-bold" id="{{$recommend_post->id}}">{{ $recommend_post->title }}</h1>
                        @if($recommend_post->image)
                            <img src="{{ $recommend_post->image }}" class="img-fluid w-100" alt="投稿画像">
                            <br>
                        @endif
                        <p class="index-content content mt-3 fs-5">{{ $recommend_post->content }}</p>
                        <p> {{ $recommend_post->updated_at}}</p>
                        <hr>
                    </a>
                    <div class="row mb-3">
                        <div class="col-md-4 text-center fs-5">
                            <button data-value="{{$recommend_post->id}}" class="post-btn ikitai-btn text-decoration-none btn btn-{{ $recommend_posts_array[$recommend_post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$recommend_post->id}} fa-{{$recommend_posts_array[$recommend_post->id]['ikitai-icon']}} fa-face-grimace me-1"></i><span class="ikitai-count{{$recommend_post->id}}">{{ $recommend_post->ikitais->count() }}</span><span class="ikitai-label{{$recommend_post->id}} ms-2 fs-5 align-middle">{{ $recommend_posts_array[$recommend_post->id]['ikitai-label'] }}</span></button>
                        </div>
                        
                        <div class="col-md-4 text-center fs-5">
                            <button data-value="{{$recommend_post->id}}" class="post-btn empathy-btn text-decoration-none btn btn-{{ $recommend_posts_array[$recommend_post->id]['empathy-btn'] }} fs-4 w-75"><i class="empathy-icon{{$recommend_post->id}} fa-{{$recommend_posts_array[$recommend_post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$recommend_post->id}}">{{ $recommend_post->empathies->count() }}</span><span class="empathy-label{{$recommend_post->id}} ms-2 fs-5 align-middle">{{ $recommend_posts_array[$recommend_post->id]['empathy-label'] }}</span></button>
                        </div>

                        <div class="col-md-4 text-center fs-5">
                            <a href="/laravel-osusumeshi/public/posts/{{$recommend_post->id}}#comment" class="post-btn btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $recommend_post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="mt-4 display-2 fw-bold">◎新着投稿</h2>
        <div class="d-flex align-items-center justify-content-center row">
            @foreach($new_posts as $post)
                <div class="card col-md-9 col-11 ps-0 mb-3">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                    <div class="card-body pb-0">
                        <a class="fs-3 text-decoration-none" href="{{route('mypage',$post->user->id) }}"><i class="fa-solid fa-circle-user me-2"></i>{{ $post->user->name }}</h3>
                        <hr>    
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                        
                            <p class="mb-1"><span class="me-1">{{ $post->prefecture->name }}</span>><span class="ms-1 me-1">{{ $post->city }}</span>><span class="ms-1 fs-4 fw-bold">{{ $post->shop_name }}</span></p>
                            <h1 class="post-title fw-bold" id="{{$post->id}}">{{ $post->title }}</h1>
                            @if($post->image)
                                <img src="{{ $post->image }}" class="img-fluid w-100"  alt="投稿画像">
                                <br>
                            @endif
                            <p class="index-content content mt-3 fs-5">{{ $post->content }}</p>
                            <p> {{ $post->updated_at}}<p>
                            <hr>
                        </a>
                        <div class="row mb-2">
                            <div class="col-md-4 text-center fs-5">
                                <button data-value="{{$post->id}}" class="post-btn ikitai-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="ikitai-icon{{$post->id}} fa-{{$posts_array[$post->id]['ikitai-icon']}} fa-face-grimace me-1"></i><span class="ikitai-count{{$post->id}}">{{ $post->ikitais->count() }}</span><span class="ikitai-label{{$post->id}} ms-2 fs-6 align-middle">{{ $posts_array[$post->id]['ikitai-label'] }}</span></button>
                            </div>
                            
                            <div class="col-md-4 text-center fs-5">
                                <button data-value="{{$post->id}}" class="post-btn empathy-btn text-decoration-none btn btn-{{ $posts_array[$post->id]['ikitai-btn'] }} fs-4 w-75"><i class="empathy-icon{{$post->id}} fa-{{$posts_array[$post->id]['empathy-icon']}} fa-hand me-1"></i><span class="empathy-count{{$post->id}}">{{ $post->empathies->count() }}</span><span class="empathy-label{{$post->id}} ms-2 fs-6 align-middle">{{ $posts_array[$post->id]['empathy-label'] }}</span></button>
                            </div>

                            <div class="col-md-4 text-center fs-5">
                                <a href="/laravel-osusumeshi/public/posts/{{$recommend_post->id}}#comment" class="post-btn btn btn-success fs-4 w-75"><i class="fa-solid fa-comment me-1"></i><span>{{ $recommend_post->comments->count() }}</span><span class="ms-2 fs-5 align-middle">コメント</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

 @endsection