<!-- footer
	================================================== -->
<footer style="background: {{config('siteSetting.footer_bg_color')}} ; color:{{config('siteSetting.footer_text_color')}}">
	<div class="container">
		<div class="footer-widgets-part">
			<div class="row">
				<div class="col-md-3">
					<div class="widget text-widget">
						
						<a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('upload/images/logo/'.config('siteSetting.footer_logo'))}}" width="250" alt=""></a>

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
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<?php $pages = App\Models\Page::where('menu', 3)->where('status', 1)->get(); ?>
							<ul style="margin-bottom: 5px;padding: 0; display: inline-block;padding: 0">
							@foreach($pages as $page)
							<li style="list-style: none;float: left;border-radius: 3px;padding: 3px 8px; margin: 5px;border: 1px solid {{config('siteSetting.footer_text_color')}}"><a style="color:{{config('siteSetting.footer_text_color')}}" href="{{route('page', [$page->page_slug])}}">{{$page->page_name_bd}}</a></li>
						
							@endforeach
							</ul>
							
						</div>
						<div class="col-md-8">
							<div class="widget posts-widget">
								<h1 style="color:#4CEFB3;border-bottom: 1px solid #4CEFB3">{{$_SERVER['SERVER_NAME']}} magazine is the next generation media</h1>
								<p style="color:{{config('siteSetting.footer_text_color')}}">{!! config('siteSetting.about') !!}</p>					
							</div>
						</div>
					
						<div class="col-md-4">
							<h1 style="color:#4CEFB3;border-bottom: 1px solid #4CEFB3">	Our Newsletter</h1>
							<p style="color:{{config('siteSetting.footer_text_color')}}">To stay on top of the server-changing world of business, subscribe now to our newsletters</p>
							<span style="position: relative;display: block;overflow: hidden;"><input type="text" placeholder="Your email address" class="form-control" name="newsletter">
							<button style="position: absolute;  right: 0; top: 0; padding: 7px; background: #4cefb3;  color: #fff; border: none;">SIGN UP</button></span>
							<li style="color:{{config('siteSetting.footer_text_color')}}">We hate spam as much as you do.</li>
						    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-last-line" style="background: {{config('siteSetting.copyright_bg_color')}} ; color:{{config('siteSetting.copyright_text_color')}}; border:none;">
		<div class="container" style=" border-top: 1px solid #4CEFB3;padding-top: 10px;">
			<div class="row">
				<div class="col-md-12">
					<p style="text-align: center; color:{{config('siteSetting.copyright_text_color')}}">{!! config('siteSetting.copyright_text') !!}</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End footer -->

