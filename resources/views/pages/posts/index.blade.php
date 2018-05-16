@extends('layouts.app')

@section('title', 'Post')

@section('content')

<div class="single-blog">
    <a href="#"><h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3></a>
    <img src="img/blog-image.jpg" alt="Blog Image" />
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
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

@endsection