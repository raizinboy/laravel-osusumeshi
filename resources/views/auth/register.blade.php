@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-6 col-11 ms-0 me-0">
             <h3 class="mt-3 mb-3 fw-bold">新規会員登録</h3>
 
             <hr>
 
             <form method="POST" action="{{ route('register') }}">
                 @csrf
 
                 <div class="form-group row mb-1">
                     <label for="name" class="col-md-6 col-form-label text-md-left fw-bold">アカウント名（10文字まで）<span class="osusumeshi-require-input-label-text">必須</span></label>
 
                     <div class="col-md-6">
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror osusumeshi-login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="おすすめし　たろう">
 
                         @error('name')
                            @foreach($errors->get('name') as $message)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @endforeach
                         @enderror
                     </div>
                 </div>
 
                 <div class="form-group row mb-1">
                     <label for="email" class="col-md-6 col-form-label text-md-left fw-bold">メールアドレス<span class="osusumeshi-require-input-label-text">必須</span></label>
 
                     <div class="col-md-6">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror osusumeshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="osusumeshi@gmail.com">
 
                         @error('email')
                            @foreach($errors->get('email') as $message)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @endforeach
                         @enderror
                     </div>
                 </div>
 
                 <div class="form-group row mb-1">
                     <label for="password" class="col-md-6 col-form-label text-md-left fw-bold">パスワード<span class="osusumeshi-require-input-label-text">必須</span></label>
 
                     <div class="col-md-6 position-relative">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror osusumeshi-login-input" name="password" required autocomplete="new-password">
                         <i class="show_password_register_input_btn align-items-center fa-solid fa-eye pe-0" id="show_password_btn"></i>
                         @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
 
                 <div class="form-group row mb-1">
                 <label for="password_confirm" class="col-md-6 col-form-label text-md-left fw-bold">パスワード(確認用)<span class="osusumeshi-require-input-label-text">必須</span></label>
                     <div class="col-md-6 position-relative">
                         <input id="password_confirm" type="password" class="form-control osusumeshi-login-input" name="password_confirmation" required autocomplete="new-password">
                         <i class="show_password_register_input_btn fa-solid fa-eye" id="show_password_confirm_btn"></i>
                     </div>
                 </div>
 
                 <div class="form-group">
                     <button type="submit" class="multiClickBlock btn btn-primary osusumeshi-submit-button mt-2 w-100">
                         アカウント作成
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 @endsection