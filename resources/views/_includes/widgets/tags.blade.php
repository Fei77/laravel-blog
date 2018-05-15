<div class="widget sidebar-tags">
    <span>Tags</span>
    <div class="widget-body">

        @foreach($tags as $tag)
            <a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name or '' }}</a>
        @endforeach
        
    </div>
</div>