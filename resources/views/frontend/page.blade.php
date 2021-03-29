
@extends('frontend.layouts.master')
@section('title')
    @if($find_page){{$find_page->page_name_bd}} | @endif  বিডি টাইপ
@endsection
@section('Metatag') @endsection
@section('content')
<?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'custom_page')->where('status', 1)->get();
    $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 2){
            $top_head_right = $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
    }
?>
		<section class="ticker-news category">
			<div class="container">
				<div class="row">
					<div class="col-sm-8" >
						<div class="category-title">
							<span class="breaking-news" id="head-title">@if($find_page) {{$find_page->page_name_bd}} @else Not Found @endif</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="rightAds">
                            {!! $top_head_right !!}
                        </div>
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
	                        <li><i class="fa fa-home"></i>  হোম / <span href="#">@if($find_page){{$find_page->page_name_bd}} @endif</span></li>
	                    </ul>
	                    <div class="advertisement">
	                        <div class="desktop-advert">
	                           {!! $topOfNews !!}
	                        </div>
                   		</div>
                        @if($get_page)
							{!! $get_page !!}
                        @else
                        <h2>Page not fount!.</h2>
                        @endif
                        <div class="row" id="sticky-conent">
                            <div class="col-md-12 col-sm-12">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
					</div>


					<div class="col-sm-3 div_border">
						<div class="sidebar large-sidebar">
							<div class="widget features-slide-widget">
	                            <div class="advertisement">
	                                <div class="desktop-advert">
	                                    {!! $sitebarTop !!}
	                                </div>
	                            </div>
	                        </div>
							<!-- sidebar -->
							@include('frontend.layouts.sitebar')
							<div class="widget features-slide-widget">
	                            <div class="advertisement">
	                                <div class="desktop-advert">
	                                    {!! $sitebarBottom !!}
	                                </div>
	                                
	                            </div>
	                        </div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End block-wrapper-section -->
@endsection
