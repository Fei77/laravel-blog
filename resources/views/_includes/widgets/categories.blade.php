<div class="widget">
    <span>Categories</span>
    <div class="widget-body">
        <ul class="category-list">

            @foreach($categories as $category)
                <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name or '' }}</a></li>
            @endforeach
    
        </ul>
    </div>
</div>