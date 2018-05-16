@extends('layouts.app')

@section('title', 'Home')

@section('content')

@foreach($posts as $post)
    <div class="single-blog">
        <a href="{{ route('posts.show', $post->slug) }}"><h3 class="title">{{ $post->title or '' }}</h3></a>
        <img src="{{ $post->image_url }}" alt="Blog Image" />
        <p>{{ $post->excerpt or '' }}</p>
        <div class="blog-info">
            <ul>
                <li><a href="">{{ $post->published_date or '' }}</a></li>
                <li><a href="">{{ $post->author->name }}</a></li>
                <li><a href="">{{ $post->category->name }}</a></li>
                {{-- <li><a href="">10 Comments</a></li> --}}
            </ul>
            
            <div class="read-more pull-right">
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-readmore">Continue Reading</a>
            </div>
            
        </div>
        
    </div>
@endforeach

@endsection