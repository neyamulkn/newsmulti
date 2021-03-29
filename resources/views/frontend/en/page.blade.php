
@extends('frontend.en.layouts.master')
@section('title')
    @if($find_page){{$find_page->page_name_en}} | @endif  Bdtype
@endsection
@section('Metatag') @endsection
@section('content')

		<section class="ticker-news category">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="category-title">
							<span class="breaking-news" id="head-title">@if($find_page) {{$find_page->page_name_en}} @else Not Found @endif</span>
						</div>
					</div>
					<div class="col-sm-4">
						<img src="{{asset('frontend')}}/upload/addsense/add.jpg" height="45">
					</div>
				</div>
			</div>
		</section>
		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container section-body">
				<div class="row">
					<div class="col-sm-9" id="sticky-conent">
						<ul class="category-news">
	                        <li><i class="fa fa-home"></i>  Home / <span href="#">@if($find_page){{$find_page->page_name_en}} @endif</span></li>
	                    </ul>
                        @if($get_page)
						{!! $get_page !!}
                            @else
                        <h2>Page not fount!.</h2>
                            @endif
					</div>


					<div class="col-sm-3 div_border" id="sticky-conent">
						<div class="sidebar large-sidebar">
							<!-- sidebar -->
							 @include('frontend.en.layouts.sitebar')
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End block-wrapper-section -->
@endsection
