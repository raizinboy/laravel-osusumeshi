@extends('layouts.app')
 
 @section('content')
 <div class="container mb-5">
    @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-md-10 col-10 alert alert-primary p-5 m-2 fs-1 border rounded-3 fw-bold text-center">{{ session('message') }}</div>
    </div>
    @endif
     <div class="row justify-content-center">
         <div class="col-md-6 col-11">
             <span>
                 <a href="{{ route('mypage',Auth::id()) }}" class="top_btn">マイページ</a> > 会員情報の編集/削除
             </span>
 
             <h1 class="mt-3 mb-3 fs-1">会員情報の編集/削除</h1>
             <hr>
 
             <!--アップデートフォーム-->
             <form method="POST" action="{{ route('mypage.update') }}">
                 @csrf
                 <input type="hidden" name="_method" value="PUT">
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="name" class="text-md-left osusumeshi-edit-user-info-label">アカウント名（10文字まで）</label>
                     </div>
                     <div class="collapse show editUserName">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror mb-3" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="おすすめし　たろう">
                        @error('name')
                            @foreach($errors->get('name') as $message)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @endforeach
                        @enderror
                     </div>
                 </div>
 
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="email" class="text-md-left osusumeshi-edit-user-info-label">メールアドレス</label>
                     </div>
                     <div class="collapse show editUserMail">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">
                        @error('email')
                            @foreach($errors->get('email') as $message)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @endforeach
                        @enderror
                     </div>
                 </div>
                 
                 <hr class="mb-4">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary col-md-3 mb-3">
                    保存する
                    </button>
                </div>
            </form>

            <!--削除フォーム-->
            <form method="POST" action="{{ route('mypage.destroy') }}" class="col-md-12 text-center">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <div class="btn btn-danger col-md-3" data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal">退会する</div>
            
                @include('modals.delete_user_modal')
            </form>
            
         </div>
     </div>
 </div>
 @endsection