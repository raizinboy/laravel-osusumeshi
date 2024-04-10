<div class="modal fade" id="report-comment-modal{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="commentReportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <label class="modal-title ms-1 fs-3" id="postReportLabel">このコメントを報告する。</label>
                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="email" class="fs-4">返信可能なメールアドレス<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror osusumeshi-login-input" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" placeholder="osusumeshi@gmail.com">
                @error('email')
                    @foreach($errors->get('email') as $message)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @endforeach
                @enderror
                <input type="hidden" name="comment_id"  value="{{$comment->id}}">
                <label for="category" class="fs-4">報告カテゴリー<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                <br>
                <select name="category" class="mt-1 mb-1">
                    <option value='' disabled selected style='display:none;'>選択してください</option>
                    <option value="誹謗・中傷">誹謗・中傷</option>
                    <option value="ユーザーへの嫌がらせ">ユーザーへの嫌がらせ</option>
                    <option value="不適切なコンテンツ">不適切なコンテンツ</option>
                    <option value="プライバシーの侵害">プライバシーの侵害</option>
                    <option value="その他">その他</option>
                </select>
                <br>
                <label for="content" class="fs-4">報告内容<span class="osusumeshi-posts-input-label fs-6 d-inline-block align-text-top mt-1">必須</span></label>
                <textarea name="content" rows="7" class="form-control @error('content') is-invalid @enderror"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-primary me-3">送信</button>
            </div>
        </div>
    </div>
</div>