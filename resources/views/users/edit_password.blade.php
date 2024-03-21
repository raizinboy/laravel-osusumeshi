@extends('layouts.app')
 
 @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h1 class="mt-3 mb-3 fs-1">パスワードの変更</h1>
            <hr>

            <form method="post" action="{{ route('mypage.update_password' )}}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group mb-2">
                    <div>
                        <label for="password" class="text-md-left ms-3 mb-2">新しいパスワード</label>
                    </div>
                    <div class="row position-relative">
                        <input id="password" type="password" class="@error('password') is-invalid @enderror col-md-11 p-2 ms-4 border rounded" name="password" required autocomplete="new-password">
                        <i class="col-md-1 show_password_edit_input_btn fa-solid fa-eye z-index-1" id="show_password_btn"></i>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="password_confirm" class="text-md-left ms-3 mb-2">新しいパスワード(確認用) 
                    </div>
                    
                    <div class="row position-relative">
                        <input id="password_confirm" type="password" class="col-md-11 p-2 ms-4 border rounded" name="password_confirmation" required autocomplete="new-password">
                        <i class="col-md-1 show_password_edit_input_btn align-items-center fa-solid fa-eye" id="show_password_confirm_btn"></i>
                    </div>
                </div>  

                <hr>
        
                <div class="text-center">
                    <button type="submit" class="btn btn-success col-md-3 mb-3">
                        パスワード更新
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
 @endsection