<div class="widget">
    <span>LATEST POSTS</span>
    <div class="widget-body">
        <ul class="category-list">

            @foreach($posts as $post)
                <li>
                    <a class="items" href="{{ route('posts.show', $post->slug) }}">{{ $post->title or '' }}</a>
                    {{ $post->published_date }}
                </li>
            @endforeach

        </ul>
    </div>
</div>