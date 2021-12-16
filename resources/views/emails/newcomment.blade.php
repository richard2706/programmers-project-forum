<b>There is a new comment on your post: {{ $post->title }}</b>
<p>{{ $comment->userProfile->username }} commented:</p>
<p>{{ substr($comment->content, 0, 100) . ((strlen($comment->content) > 100) ? '...' : '') }}</p>
<a class="hover:underline" href="{{ route('posts.show', compact('post')) }}">Go to your post</a>
