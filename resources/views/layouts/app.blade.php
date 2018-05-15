<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		@stack('meta')
		<!-- google fonts -->

		<!-- Css link -->
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/owl.transitions.css">
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/lightbox.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/preloader.css">
		<link rel="stylesheet" href="css/image.css">
		<link rel="stylesheet" href="css/icon.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/responsive.css">

        @stack('styles')

	</head>
	<body id="top">

    @include('_includes.navbar')

	<div class="wrapper">
		<section id="global-header">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block text-center">
							<h1>BIG HEADLINE FOR BLOG</h1>
							<p>13 MARCH 2015 / BY SARA SMITH</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="blog-left">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-0 col-sm-10 col-sm-offset-1">
						
						@yield('content')
						
					</div>
					<div class="col-md-3 col-md-offset-1 col-sm-4">
                        
                        @include('_includes.widgets.search')
                        
                        @include('_includes.widgets.categories')
                        
                        {{-- @include('_includes.widgets.about') --}}
                        
                        {{-- @include('_includes.widgets.text') --}}
                        
                        @include('_includes.widgets.posts')
                        
                        @include('_includes.widgets.tags')
                        
                        @include('_includes.widgets.comments')
                        
						<div class="widget">
							<a href="#">
								<img class="img-responsive" src="img/blog-img7.jpg" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		@include('_includes.footer')
	</div>

		<!-- load Js -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&amp;sensor=false"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/lightbox.js"></script>
		<script src="js/jquery.counterup.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/html5lightbox.js"></script>
		<script src="js/jquery.mixitup.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/jquery.scrollUp.js"></script>
		<script src="js/jquery.sticky.js"></script>
		<script src="js/jquery.nav.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>