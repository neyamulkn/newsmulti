<!doctype html>
<html lang="en" class="no-js">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
    <?php $setting = App\Models\Setting::first(); ?>
    @if(Request::is('/'))
        <title>{{ $setting->title }}</title>
        <meta itemprop="name" content="{{ $setting->title }}">
    @else
        <title>@yield('title')</title>
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @yield('MetaTag')
    <script type="application/ld+json">
	{
	"@context": "https://schema.org",
	"name":"Bdtype",
	"@type": "Organization",
	"url": "{{url('/')}}",
	"logo": "{{ asset('frontend')}}/images/logo-black.png",
	"contactPoint" : [
		{
			"@type" : "ContactPoint",
			"telephone" : "+8801572023023",
			"email" : "bdtype@gmail.com",
			"contactType" : "customer service"
		}
	],
	"sameAs" : [
		"https://facebook.com/bdtype",
		"https://twitter.com/bdtype",
		"https://youtube.com/bdtype",
		"https://pinterest.com/bdtype",
		"https://plus.google.com/+bdtype",
		"https://instagram.com/bdtype"
		"https://bdtype.com/rss/rss.xml"
	]
	}
    </script>

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "url": "{{url('/')}}",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "{{route('search_result')}}?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
    </script>

    {!!  $setting->header_text !!}

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
	<link href="{{ asset('frontend/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/jquery.bxslider.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/magnific-popup.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.carousel.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.theme.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/ticker-style.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css') }}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/leftsidebar-mobile.css') }}" media="screen">
	<link href="{{asset('frontend/css/search/main.css')}}" rel="stylesheet" />
	<link rel="icon" href="{{ asset('frontend')}}/images/fevicon.png" type="image/x-icon">

	@yield('css')
	<style type="text/css">
		.map img{
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
		.ticker{width: 66% !important;}
	</style>
</head>
<body>

	<!-- Container -->
	<div id="container">
		@include('frontend.en.layouts.header')
		@yield('content')
		@include('frontend.en.layouts.footer')
	</div>
	<!-- End Container -->

	<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.migrate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.bxslider.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.ticker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.imagesloaded.min.js') }}"></script>
  	<script type="text/javascript" src="{{ asset('frontend/js/jquery.isotope.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/plugins-scroll.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
    {!!  $setting->footer !!}
	<script type="text/javascript">
	function search_bar(src_key){

		if(src_key != ''){
			$.ajax({
				method:'get',
				url:'{{ route("search_news") }}',
				data:{src_key:src_key, _token: '{{csrf_token()}}'},
				datatype: "text",
				success:function(data){
					if(data !=null){

						document.getElementById('search_bar').style.display = 'block';
						document.getElementById('show_suggest_key').innerHTML = data;
					}else{
						document.getElementById('search_bar').style.display = 'none';
					}
				}
			});
		}else{
			document.getElementById('search_bar').style.display = 'none';
		}
	}
	</script>

	<script>
		//Get the button
		var mybutton = document.getElementById("myBtn");
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		    mybutton.style.display = "block";
		  } else {
		    mybutton.style.display = "none";
		  }
		}
		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		  document.body.scrollTop = 0;
		  document.documentElement.scrollTop = 0;
		}
	</script>

	<!-- leftsidebar-mobile -->
	<script type="text/javascript">
	    $(document).ready(function () {
	        $('#mobile-menu').on('click', function () {
	            $('#menu-sidebar').toggleClass('active');
	        });
	    });
	</script>
	@yield('js')

	@if(Auth::check()) 
	<script>

	  	function readNotify(id){
			
			var url = "{{route('readNotify', ':id')}}";
			url = url.replace(":id", id);
			$.ajax({
	            url:url,
	            method:"get",
		    });
		}

	</script>
	@endif
</body>
</html>
