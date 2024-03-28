@if($post->is_ikitaied_by_auth_user())
<a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="ikitai-btn text-decoration-none btn btn-info fs-4"><i class="fa-solid fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">解除</span></a>
@else
<a href="{{ route('posts.ikitai',$post->id) }}" id="ikitai-btn{{$post->id}}" class="ikitai-btn text-decoration-none btn btn-info fs-4"><i class="fa-regular fa-face-grimace me-1"></i>{{ $post->ikitais->count() }}<span class="ms-2 fs-6 align-middle">行きたい</span></a>
@endif