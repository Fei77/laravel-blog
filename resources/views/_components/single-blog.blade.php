<div class="single-blog">
    <a href="{{ $route or '' }}"><h3>{{ $title or '' }}</h3></a>
    <img src="{{ $image or '' }}" alt="Blog Image" />
    <p>{{ $content or '' }}</p>
    <div class="blog-info">
        <ul>
            <li><a href="">Date: June 05, 2016</a></li>
            <li><a href="">Author Name</a></li>
            <li><a href="">Category</a></li>
            <li><a href="">10 Comments</a></li>
        </ul>
        
        <div class="read-more pull-right">
            <a href="#" class="btn btn-readmore">Continue Reading</a>
        </div>
        
    </div>
    
</div>