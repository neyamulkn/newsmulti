@extends('frontend.layouts.master')
@section('title')
    Read Later News | বিডি টাইপ
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
$get_ads = App\Models\Addvertisement::where('page', 'user_profile')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 1){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 2){
        $topOfNews = $ads->add_code;
    }elseif($ads->position == 3){
        $middleOfNews = $ads->add_code;
    }elseif($ads->position == 4){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 5){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position ==6){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position ==7){
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
                           <span class="breaking-news" id="head-title">Read Later News ({{$read_later_news->total()}})</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
					<div class="col-sm-3">
						@include('frontend.users.sidebar')
					</div>
					<div class="col-sm-6">
						<!-- block content -->
						<div class="block-content">
							<!-- grid box -->
							<div class="grid-box">
								

								<div class="row">
									@foreach($read_later_news as $show_news)
                                    <?php $i = 1; ?>
									<div class="col-md-3 col-sm-4 col-xs-6">
										<div class="item news-post standard-post">
											<div class="post-gallery">
												<img style="max-height: 100%" src="{{ asset('upload/images/thumb_img/'. $show_news->news->image->source_path)}}" alt="">
												<a class="category-post sport" href="{{ route('category', [$show_news->news->categoryList->cat_slug_en]) }}">{{$show_news->news->categoryList->category_bd}}</a>
											</div>
											<div class="post-content">
												<h2><a href="{{route('news_details', $show_news->news->news_slug)}}">{{Str::limit($show_news->news->news_title, 70)}} </a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->news->publish_date)}}</li>
													<li><i class="fa fa-eye"></i>{{$show_news->news->view_counts}}</li>
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
                                    {{$read_later_news->links()}}
                                </div>
						    </div>
							<!-- End grid box -->
						</div>
						<!-- End block content -->
                        <div class="advertisement">
                            <div class="desktop-advert">
                                {!! $bottomOfNews !!}
                            </div>
                            <div class="tablet-advert">
                                {!! $bottomOfNews !!}
                            </div>
                            <div class="mobile-advert">
                                {!! $bottomOfNews !!}
                            </div>
                        </div>
					</div>

					<div class="col-sm-3">
						<div class="sidebar large-sidebar">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                            <div class="tablet-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                            <div class="mobile-advert">
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
	                            <div class="tablet-advert">
	                                {!! $sitebarBottom !!}
	                            </div>
	                            <div class="mobile-advert">
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
