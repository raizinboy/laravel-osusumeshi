<div class="modal fade" id="update-profile-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="updateProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <label class="modal-title ms-1 fs-3" id="updateProfileLabel">プロフィールを編集</label>
                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="content" class="fs-4">＜自己紹介＞</label>
                <textarea name="content" rows="7" class="form-control @error('content') is-invalid @enderror" placeholder="aaaaa">@if(isset($user->profile->content)){{$user->profile->content}}@endif</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-primary me-3">保存</button>
            </div>
        </div>
    </div>
</div>