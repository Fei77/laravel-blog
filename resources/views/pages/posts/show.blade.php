@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="blog-img row">
        <div class="col-md-12">
            <img class="img-responsive" src="{{ $post->image_url }}" alt="">
        </div>
    </div>
    <div class="block">
        <span class="first-child-span">{{ $post->title or '' }}</span>

        {!! $post->content or '' !!}

        <div class="tags">
            <h5>Tags</h5>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name or '' }}</a>
                @endforeach
        </div>
        
        <!-- social media icon -->
        <div class="media-link">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
@endsection