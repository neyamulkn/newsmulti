@extends('frontend.layouts.master')
@section('title')
    {{$reporter->name}} | বিডি টাইপ
@endsection
@section('Metatag') @endsection
<style type="text/css">
	ul.autor-list > li .autor-box .autor-content .autor-title ul.autor-social li a{
		color: #fff !important;
	}
	ul.autor-list > li .autor-box img{
		border:3px solid;
	}
</style>
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'reporter_page')->where('status', 1)->get();
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
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

    $formatBng = Carbon\Carbon::parse($date)->diffForHumans();
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>

@section('content')


	<section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title"><a style="color: #fff;font-weight: bold;" href="{{route('user_profile', $reporter->username)}}">{{$reporter->name}} </a></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="rightAds">
                            {!! $top_head_right !!}
                        </div>
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
						<!-- block content -->
						<div class="block-content">
							<!-- grid box -->
							<div class="grid-box">
								<ul class="autor-list">
									<li>
										<div class="autor-box">
											<div class="row">
												<div class="col-xs-4 col-sm-2">
													<img src="{{asset('upload/images/users/thumb_image/'. $reporter->image)}}" alt="{{$reporter->username}}">
												</div>
												<div class="col-xs-8 col-sm-10">
													<span><a style="color: #fff;font-weight: bold;" href="{{route('user_profile', $reporter->username)}}">{{$reporter->name}} </a></span><br/>Designation: {{$reporter->userinfo->designation}}<br/>
													Gander: {{($reporter->gender == 1) ? 'Male' : 'Female'}}<br/>
													Location: {{$reporter->userinfo->present_address}}
													<div class="autor-content">
														<div class="autor-title">
															<ul class="autor-social">
																<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
																<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
																<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
																<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
																<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
																<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
																<li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="autor-last-line">
											<ul class="autor-tags">
												<li><span><i class="fa fa-bars"></i></span></li>
												<li><a href="#">News ({{$get_news->total()}})</a></li>
												<li><a href="#">Following</a></li>
											</ul>
										</div>
									</li>
								</ul>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="advertisement">
                                            <div class="desktop-advert">
                                                {!! $topOfNews !!}
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
								<div class="row">
									@foreach($get_news as $show_news)
                                    <?php $i = 1; ?>
									<div class="col-md-3 col-sm-4 col-xs-6">
										<div class="item news-post standard-post">
											<div class="post-gallery">
												<img style="max-height: 100%" src="{{ asset('upload/images/thumb_img/'. $show_news->image->source_path)}}" alt="">
												<a class="category-post sport" href="{{ route('category', [$show_news->categoryList->cat_slug_en]) }}">{{$show_news->categoryList->category_bd}}</a>
											</div>
											<div class="post-content">
												<h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 70)}} </a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>
													<li><i class="fa fa-eye"></i>{{$show_news->view_counts}}</li>
												</ul>
											</div>
										</div>
									</div>
                                        @if($i==12)
                                            <div class="advertisement">
                                                <div class="desktop-advert">
                                                    {!! $middleOfNews !!}
                                                </div>
                                                <div class="tablet-advert">
                                                    {!! $middleOfNews !!}
                                                </div>
                                                <div class="mobile-advert">
                                                    {!! $middleOfNews !!}
                                                </div>
                                            </div>
                                        @endif
                                        <?php $i++; ?>
									@endforeach
								</div>
                                <div class="pagination-box">
                                    {{$get_news->links()}}
                                </div>
						    </div>
							<!-- End grid box -->
						</div>
						<!-- End block content -->
                        <div class="advertisement">
                            <div class="desktop-advert">
                                {!! $bottomOfNews !!}
                            </div>
                            
                        </div>
					</div>

					<div class="col-sm-3" id="sticky-conent">
						<div class="sidebar large-sidebar">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarTop !!}
                                </div>
                               
                            </div>
						<!-- sidebar -->
						 @include('frontend.layouts.sitebar')
						<!-- End sidebar -->
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                               
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</section>
		<!-- End block-wrapper-section -->
@endsection
