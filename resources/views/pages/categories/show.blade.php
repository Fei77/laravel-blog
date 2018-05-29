@extends('layouts.app')

@section('title', "Category {$category->name}")

@push('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $category->name or '' }}">
    <meta itemprop="description" content="{{ $description or '' }}">
    <meta itemprop="image" content="{{ asset((isset($image) ? $image : '')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('company.contacts.socials.twitter') }}">
    <meta name="twitter:title" content="{{ $title or '' }}">
    <meta name="twitter:description" content="{{ $description or '' }}">
    <meta name="twitter:image:src" content="{{ asset((isset($image) ? $image : '')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $title or '' }}" />
    <meta property="og:type" content="place" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset((isset($image) ? $image : '')) }}" />
    <meta property="og:description" content="{{ $description or '' }}" />
    <meta property="og:site_name" content="{{ Setting::get('company.name') }}" />
    <meta property="article:published_time" content="{{ $created_at or '' }}" />
    <meta property="article:modified_time" content="{{ $updated_at or '' }}" />
@endpush

@section('content')

    @foreach($category->posts as $post)
    <div class="single-blog">
        <a href="{{ route('posts.show', $post->slug) }}"><h3 class="title">{{ $post->title or '' }}</h3></a>
        <img src="{{ $post->image_url }}" alt="Blog Image" />
        <p>{{ $post->excerpt or '' }}</p>
        <div class="blog-info">
            <ul>
                <li><a href="{{ route('posts.search') }}">{{ $post->published_date or '' }}</a></li>
                <li><a href="{{ route('posts.search') }}">{{ $post->author->name }}</a></li>
                <li><a href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a></li>
                {{-- <li><a href="">10 Comments</a></li> --}}
            </ul>
            
            <div class="read-more pull-right">
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-readmore">Continue Reading</a>
            </div>
            
        </div>
        
    </div>
    @endforeach
    
@endsection