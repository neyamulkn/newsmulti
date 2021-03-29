
<!-- footer
	================================================== -->
<footer>
	<div class="container">
		<div class="footer-widgets-part">
			<div class="row">
				<div class="col-md-3">
					<div class="widget text-widget">
						
						<a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('frontend')}}/images/logo.png" width="250" alt=""></a>
						<p>Bdtype Most Popular Bangla & English
Newspaper Published From Bangladesh</p>
					</div>
					
				</div>
				<div class="col-md-3">
					<div class="widget posts-widget">
						<h1>Address</h1>
						<p  style="color:#fff">ব্যবস্থাপনা পরিচালক : কালাম খান<br/>
						বিডিটাইপ,  হাউস: ১০৬, ব্লক: বি, শুক্র ভাঙা,<br/>
						দিয়াবাড়ি, উত্তরা, ঢাকা-১২৩০ ।<br/>
						মোবাইল: +8801572023023<br/>
						ই-মেইল: bdtype@gmail.com</p>
					</div>
				</div>
				
				<div class="col-md-6">
					<h1>Info </h1>
					<p  style="color:#fff">Bdtype.com is one of the popular bangla news portals. It has begun with commitment of fearless, investigative, informative and independent journalism. This online portal has started to provide real time news updates with maximum use of modern technology from 2015. Latest & breaking news of Bangladesh and abroad, entertainment, lifestyle, special reports, politics, economics, culture, education, information technology, health, sports, columns and features are included in it.</p>
				     <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
				</div>
				
			</div>
		</div>
	</div>

		<div class="footer-last-line" style="background:#006935; color:#fff;">
			<div class="container">
			<div class="row">
				<div class="col-md-4">
					<p>© সর্বস্বত্ব সংরক্ষিতঃ ২০১৭ । বিডি টাইপ পত্রিকা আগামী প্রজন্মের মিডিয়া |</p>
				</div>
				<div class="col-md-8">
					<nav class="footer-nav">
						<ul>
							<?php $pages = App\Models\Page::where('menu', 3)->where('status', 1)->get(); ?>
							@foreach($pages as $page)
							<li><a href="{{route('page', [$page->page_slug])}}">{{$page->page_name_en}}</a></li>
							@endforeach
						
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End footer -->

