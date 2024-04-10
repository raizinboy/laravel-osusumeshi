<div class="modal fade" id="edit-comment-modal{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editCommentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <label class="modal-title ms-1 fs-3" id="editCommentLabel">コメントを編集する</label>
                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="content" class="fs-4"><コメント></label>
                <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ $comment->content }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-primary me-3">保存</button>
            </div>
        </div>
    </div>
</div>