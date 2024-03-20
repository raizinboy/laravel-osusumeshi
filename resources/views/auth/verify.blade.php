@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
             <h3 class="text-center fw-bold">会員登録ありがとうございます！</h3>
 
             <p class="text-center">
                 現在、仮会員の状態です。  
             </p>
 
             <p class="text-center">
                 ただいま、ご入力いただいたメールアドレス宛に、<br>
                 ご本人様確認用のメールをお送りしました。  
             </p>
 
             <p class="text-center">
                 メール本文内のURLをクリックすると本会員登録が完了となります。  
             </p>

             <div>もし、確認用メールが送信されていない場合は、下記をクリックしてください。
                <form class="d-flex justify-content-center mt-2 mb-3" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link fs-4">確認メールを再送信する</button>
                </form>
            </div>

             <div class="text-center">
                 <a href="{{ url('/') }}" class="btn btn-primary osusumeshi-submit-button w-50 text-white">トップページへ</a>
             </div>
         </div>
     </div>
 </div>
 @endsection