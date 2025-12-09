<h2>Hi</h2>
<p>You have published a new blog post: {{ $post->title }}</p>
<p>
    <a href="{{ url('/posts/' . $post->id ) }}">Link to your post</a>
</p>
