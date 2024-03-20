@extends('layouts.app')
 
 @section('content')
 <div class="container d-flex justify-content-center mt-3">
     <div class="row col-md-6 col-10">
         <h1>マイページ</h1>
         <a href="{{ route('top') }}" class="text-decoration-none top_btn">＞TOPに戻る</a>
 
         <hr>
 
         <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center">
                    <i class="fas fa-user fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                        <a class="fs-3 mypage_btn" href="{{ route('mypage.edit') }}">会員情報の編集/削除</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center ps-2">
                    <i class=" fa-solid fa-lock fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                    <a class="fs-3 mypage_btn border-none" href="{{ route('mypage.edit_password') }}">パスワードの変更</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center ps-1">
                    <i class=" fa-solid fa-credit-card fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                        <a class="fs-3 mypage_btn" href="{{ route('mypage.getPaymentMethod') }}">有料会員登録</a>
                </div>
            </div>
        </div>


        <hr>
        
        @auth
        @if (auth()->user()->subscribed('default'))
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center ps-1">
                    <i class=" fa-solid fa-heart fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                        <a class="fs-3 mypage_btn" href="{{ route('mypage.favorite') }}" >お気に入り店舗一覧</a>
                </div>
            </div>
        </div>

        <hr>
 
         <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center ps-1">
                    <i class=" fa-solid fa-shop fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                        <a class="fs-3 mypage_btn" href="{{ route('reservation.show') }}" >予約の確認</a>
                </div>
            </div>
        </div>

        <hr>

        @endif
        @endauth
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-1 col-2 d-flex align-items-center ps-2">
                    <i class="fas fa-sign-out-alt fa-3x"></i>
                </div>
                <div class="col-md-10 col-9 d-flex align-items-center">
                        <a class="fs-3 mypage_btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >ログアウト</a>
                </div>
                <form id="logout-form" action= "{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
 
        <hr>
     </div>
 </div>
 @endsection