<!-- footer
	================================================== -->
<footer style="background: {{config('siteSetting.footer_bg_color')}} ; color:{{config('siteSetting.footer_text_color')}}">
	<div class="container">
		<div class="footer-widgets-part">
			<div class="row">
				<div class="col-md-3">
					<div class="widget text-widget">
						
						<a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('upload/images/logo/'.config('siteSetting.footer_logo'))}}" width="250" alt=""></a>
						<p>{{ config('siteSetting.about') }}</p>
					</div>
					
				</div>
				<div class="col-md-3">
					<div class="widget posts-widget">
						<h1 style="color:{{config('siteSetting.footer_text_color')}}; border-bottom: 1px solid {{config('siteSetting.footer_text_color')}};">Address</h1>
						<p  style="color:{{config('siteSetting.footer_text_color')}}">
						@if(config('siteSetting.site_owner'))
						{!! config('siteSetting.site_owner') !!}<br/>@endif
						@if(config('siteSetting.address'))
						{!! config('siteSetting.address') !!}<br/>@endif
						@if(config('siteSetting.phone'))
						Mobile ::{{ config('siteSetting.phone') }}<br/>@endif
						@if(config('siteSetting.email'))
						Email:: {{ config('siteSetting.email') }}<br/>@endif
						
					</div>
				</div>
				
				<div class="col-md-6">
					<h1 style="color:{{config('siteSetting.footer_text_color')}}; border-bottom: 1px solid {{config('siteSetting.footer_text_color')}};">About {{$_SERVER['SERVER_NAME']}} </h1>
					<p  style="color:{{config('siteSetting.footer_text_color')}}">@if(config('siteSetting.footer'))
						{!! config('siteSetting.footer') !!}<br/>@endif</p>
				     <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
				</div>
				
			</div>
		</div>
	</div>
	<div class="footer-last-line" style="background: {{config('siteSetting.copyright_bg_color')}} ; color:{{config('siteSetting.copyright_text_color')}}">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<p style="color:{{config('siteSetting.copyright_text_color')}}">{!! config('siteSetting.copyright_text') !!}</p>
				</div>
				<div class="col-md-8">
					<nav class="footer-nav">
						<ul>
							<?php $pages = App\Models\Page::where('menu', 3)->where('status', 1)->get(); ?>
							@foreach($pages as $page)
							<li><a style="color:{{config('siteSetting.copyright_text_color')}}" href="{{route('page', [$page->page_slug])}}">{{$page->page_name_bd}}</a></li>
							@endforeach
						
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End footer -->

