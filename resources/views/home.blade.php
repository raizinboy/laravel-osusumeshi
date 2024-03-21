@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fs-4 fw-bold text-center">報告</div>

                <div class="card-body fs-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログインしました！
                </div>
            </div>

            <div class="text-center">
                <h1>ルート未選択</h1>
                <a href="#" class="btn btn-primary mt-3 ps-3 pe-3 pt-2 pb-2">トップに戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection
