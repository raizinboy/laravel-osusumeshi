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
                    <img src="{{ asset('img/top.jpg') }}" class="crousel-img d-block w-100" alt="トップ画像1">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label mb-5">おすすめし</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="{{ asset('img/top2.jpg') }}" class="crousel-img d-block w-100" alt="トップ画像2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label mb-5">あなたのおすすめが</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-item h-100">
                    <img src="{{ asset('img/top1.jpg') }}" class="crousel-img d-block w-100" alt="トップ画像3">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label-2 text-white">みんなのおすすめに！</h1>
                        <div class="pt-4">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="{{ asset('img/top4.edited.jpg') }}" class="crousel-img d-block w-100" alt="トップ画像4">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label-2 text-white mb-5">みんなのおすすめが</h1>
                        <div class="pt-3">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <img src="{{ asset('img/top3.jpg') }}" class="crousel-img d-block w-100" alt="トップ画像5">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-label">あなたのおすすめに！</h1>
                        <div class="mt-5">
                            <a href="{{ route('posts.create') }}" class="btn btn-success me-5 pt-3 pb-3 w-25 fs-2">投稿作成へ</a>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger ms-5 pt-3 pb-3 w-25 fs-2">投稿一覧へ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <section>
        <h2>◎使い方ガイド</h1>
    </section>

    <section>
        <h2>◎新着投稿</h2>
    </section>

    <section>
        <h2>◎おすすめの投稿</h2>
    </section>
</div>

 @endsection