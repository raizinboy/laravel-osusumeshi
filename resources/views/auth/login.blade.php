@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
             <h3 class="mt-3 mb-3 fw-bold">ログイン</h3>
 
             <hr>
             <form method="POST" action="{{ route('login') }}">
                 @csrf
 
                 <div class="form-group mb-1">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror osusumeshi-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">
 
                    @error('email')
                        @foreach($errors->get('email') as $message)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @endforeach
                    @enderror
                 </div>
 
                 <div class="form-group position-relative">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror osusumeshi-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">
                    <i class="show_password_login_input_btn fa-solid fa-eye" id="show_password_btn"></i>
                     @error('password')
                        @foreach($errors->get('password') as $message)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @endforeach
                     @enderror
                 </div>
 
                 <div class="form-group">
                     <div class="form-check">
                         <input class="form-check-input border border-dark" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
 
                         <label class="form-check-label osusumeshi-check-label w-100" for="remember">
                             次回から自動的にログインする
                         </label>
                     </div>
                 </div>
 
                 <div class="form-group">
                     <button type="submit" class="mt-3 btn btn-primary osusumeshi-submit-button w-100">
                         ログイン
                     </button>
 
                     <a class="btn btn-link mt-3 d-flex justify-content-center osusumeshi-login-text" href="{{ route('password.request') }}">
                         パスワードをお忘れの場合
                     </a>
                 </div>
             </form>
 
             <hr>
 
             <div class="form-group">
                 <a class="btn btn-link mt-3 d-flex justify-content-center osusumeshi-login-text" href="{{ route('register') }}">
                     新規登録
                 </a>
             </div>
         </div>
     </div>
 </div>
 @endsection