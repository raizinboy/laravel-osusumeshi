<div class="modal fade" id="delete-comment-modal{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteCommentLabel{{$comment->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title ms-1 fs-3" id="deleteCommentLabel{{ $comment->id }}"><label>本当にコメントを削除しますか？</label></h5>
                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fs-5 text-center">一度コメントを削除すると復元することはできません。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-danger me-3">コメントを削除する</button>
            </div>
        </div>
    </div>
</div>