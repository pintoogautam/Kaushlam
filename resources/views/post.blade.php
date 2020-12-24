
@foreach ($posts as $post)
<div class="content">
  <a href="{{ route('posts.show', [$post->slug]) }}">
    <h1 class="title">{{ $post->title }}</h1>
  </a>
  <p><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</p>
  <p><b>Category:</b> {{ $post->category }}</p>
  <p>{!! nl2br(e($post->content)) !!}</p>
</div>
@endforeach
