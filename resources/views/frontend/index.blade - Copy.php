@extends('frontend.layouts.master')
@section('content')
        <?PHP
function banglaDate($date){
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        
    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>
    <section class="ticker-news">

            <div class="container">
                <div class="ticker-news-box">
                    <span class="breaking-news">breaking news</span>
                    <span class="new-news">New</span>
                    <?php $get_breaking_news = DB::table('news')->select('news.news_title', 'news.news_slug', 'news.publish_date')->take(6)->orderBy('publish_date', 'DESC')->get(); ?>
                    <ul id="js-news">
                        @if(count($get_breaking_news)>0)
                            @foreach($get_breaking_news as $breaking_news)
                                <li class="news-item"><span class="time-news">{{Carbon\Carbon::parse($breaking_news->publish_date)->format('h:i A')}}</span>  <a href="{{route('news_details', $breaking_news->news_slug)}}">{{$breaking_news->news_title}}</a></li>
                            @endforeach
                        @else <li class="news-item"><span class="time-news">01:00 am</span>  <a href="#">DioGuardi, kështu e mbrojti Kosovën në Washington, </a></li>@endif
                    </ul>
                </div>
            </div>
    </section>
    <!-- block-wrapper-section
        ================================================== -->
    <section class="block-wrapper">
        <div class="container section-body" >
            <div class="row">
                <div class="col-md-9  divrigth_border">
                    <!-- grid box -->
                    <div class="grid-box">
                        <div class="row">
                            <?php $i = 1;?>
                            @foreach($recent_section_news as $section_news)
                                @if($i==1)

                                        <div class="col-md-6 col-sm-6">
                                            <div class="news-post image-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img_box/'. $section_news->source_path)}}" alt="">
                                                    <div class="hover-box">
                                                        <div class="inner-hover">
                                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{str_limit($section_news->news_title, 60)}} </a></h2>
                                                            <ul class="post-tags">
                                                                <li><i class="fa fa-clock-o"></i>{{$section_news->subcategory_bd}}</li>
                                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-3 col-sm-3">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">
                                                    <a class="category-post world" href="#">{{$section_news->category_bd}}</a>
                                                </div>
                                                <div class="post-title">
                                                    <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{str_limit($section_news->news_title, 20)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($section_news->created_at)->format('d M, Y')}}</li>

                                                        <li><i class="fa fa-tags"></i>{{$section_news->subcategory_bd}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                @endif
                                 <?php $i++;?>
                                @endforeach
                    </div>
                    <!-- End grid box -->

                </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <div class="widget search-widget">
                        <form role="search" class="search-form">
                            <input type="text" id="search" name="search" placeholder="Search here">
                            <button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <hr/>
                    <div class="widget features-slide-widget">
                        <ul class="list-posts">
                            @foreach($sidebar_news_first as $sitebar_first)
                            <li>
                                <img src="{{ asset('upload/images/thumb_img/'. $sitebar_first->source_path)}}" alt="">
                                <div class="post-content">
                                    <h2><a href="{{route('news_details', $sitebar_first->news_slug)}}">{{$sitebar_first->news_title}}</a></h2>
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($sitebar_first->created_at)->format('d M, Y')}}</li>
                                    </ul>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="border"></div>
        <div class="container section-body" >
            <div class="row">
                <div class="col-md-9 divrigth_border">

                    <div class="row ">
                        <div class="title-section">
                            <h1><span>বিশেষ প্রতিবেদন</span></h1>
                        </div>
                        @foreach($special_reports as $special_report)
                        <div class="col-md-3">

                            <div class="item news-post standard-post">
                                <div class="post-gallery">
                                    <img src="{{ asset('upload/images/thumb_img/'. $special_report->source_path)}}" alt="">
                                    <a class="category-post tech" href="#">{{$special_report->category_bd}}</a>
                                </div>
                                <div class="post-content">
                                    <h2><a href="{{route('news_details', $special_report->news_slug)}}">{{$special_report->news_title}}</a></h2>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="clear"></div>

                    <div class="row">
                        <div class="title-section">
                            <h1><span>জাতীয়</span></h1>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($get_national_news as $national_news)
                            @if($i == 1)
                            <div class="col-md-6" style="margin-bottom: 15px">
                                <div class="news-post image-post2">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $national_news->source_path)}}" alt="">

                                        <div class="hover-box">
                                            <div class="inner-hover">

                                                <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($national_news->created_at)->format('d M, Y')}}</li>

                                                    <li><i class="fa fa-tags"></i>{{$national_news->subcategory_bd}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif($i == 2)
                                <div class="col-md-6" style="margin-bottom: 15px">
                            <div class="news-post image-post2">
                                <div class="post-gallery">
                                    <img src="{{ asset('upload/images/thumb_img/'. $national_news->source_path)}}" alt="">
                                    <div class="hover-box">
                                        <div class="inner-hover">
                                            <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($national_news->created_at)->format('d M, Y')}}</li>

                                                <li><i class="fa fa-tags"></i>{{$national_news->subcategory_bd}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           @else
                            <div class="col-md-3">

                                <div class="item news-post standard-post">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $national_news->source_path)}}" alt="">

                                    </div>
                                    <div class="post-content">
                                        <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                        <ul class="post-tags">
                                            <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($national_news->created_at)->format('d M, Y')}}</li>
                                            <li ><i class="fa fa-eye"></i>{{$national_news->subcategory_bd}}</li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                         <?php $i++; ?>
                        @endforeach
                    </div>
                    <div class="clear"></div>
                    <div class="row">
                        <div class="title-section">
                            <h1><span>অপরাধ</span></h1>
                        </div>
                        <?php $i= 1; ?>
                        @foreach($crime_posts as $crime_post)
                            @if($i == 1)
                            <div class="col-md-6">
                                <div class="item news-post standard-post">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $crime_post->source_path)}}" alt="">
                                        <a class="category-post tech" href="#">{{$crime_post->category_bd}}</a>
                                    </div>
                                    <div class="post-content">
                                        <h2><a href="{{route('news_details', $crime_post->news_slug)}}">{{$crime_post->news_title}}</a></h2>

                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($i==2)
                            <div class="col-md-6">
                                <ul class="list-posts">
                            @endif
                                 @if($i>=2)
                                    <li>
                                        <img src="{{ asset('upload/images/thumb_img/'. $crime_post->source_path)}}" alt="">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $crime_post->news_slug)}}">{{str_limit($crime_post->news_title, 50)}}</a></h2>

                                            <ul class="post-tags">
                                                <li><i class="fa fa-tags"></i>{{$crime_post->category_bd}}</li>
                                                <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($crime_post->created_at)->format('d M, Y')}}</li>
                                            </ul>
                                        </div>
                                    </li>
                                 @endif
                            <?php $i++; ?>
                         @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="sidebar large-sidebar">

                        <div class="widget social-widget">
                            <div class="title-section">
                                <h1><span>আমাদের ফেইসবুক </span></h1>
                            </div>
                            <ul class="social-share">
                                <li>
                                    <a href="#" class="rss"><i class="fa fa-rss"></i></a>
                                    <span class="number">9,455</span>
                                    <span>Subscribers</span>
                                </li>
                                <li>
                                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                    <span class="number">56,743</span>
                                    <span>Fans</span>
                                </li>
                                <li>
                                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                    <span class="number">43,501</span>
                                    <span>Followers</span>
                                </li>
                                <li>
                                    <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                    <span class="number">35,003</span>
                                    <span>Followers</span>
                                </li>
                            </ul>
                        </div>

                        <div class="widget tab-posts-widget">

                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a href="#option1" data-toggle="tab">জনপ্রিয়</a>
                                </li>
                                <li>
                                    <a href="#option2" data-toggle="tab">সর্বশেষ</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="option1">
                                    <ul class="list-posts">
                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw1.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">দেশের ক্রিকেট ধ্বংস করতেই এই ধর্মঘট : পাপন </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw2.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">পেঁয়াজ রফতানি বন্ধে বিপাকে পড়েছি, ভারতে বাণিজ্যমন্ত্রী </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw3.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">Phasellus ultrices nulla quis nibh. Quisque a lectus.  </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw4.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">Donec consectetuer ligula vulputate sem tristique cursus. </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw5.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">বিনয়াবনত জ্ঞান অন্বেষণ এবং বাস্তবতা </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="option2">
                                    <ul class="list-posts">

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw3.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">Phasellus ultrices nulla quis nibh. Quisque a lectus. </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw4.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">Donec consectetuer ligula vulputate sem tristique cursus. </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw5.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">বিনয়াবনত জ্ঞান অন্বেষণ এবং বাস্তবতা</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw1.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">দেশের ক্রিকেট ধ্বংস করতেই এই ধর্মঘট : পাপন </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="{{ asset('frontend/upload')}}/news-posts/listw2.jpg" alt="">
                                            <div class="post-content">
                                                <h2><a href="single-post.php">পেঁয়াজ রফতানি বন্ধে বিপাকে পড়েছি, ভারতে বাণিজ্যমন্ত্রী</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="advertisement">
                            <div class="desktop-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add2.gif" alt="">
                            </div>
                            <div class="tablet-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add2.gif" alt="">
                            </div>
                            <div class="mobile-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add2.gif" alt="">
                            </div>
                        </div>

                        <div class="widget post-widget">
                            <div class="title-section">
                                <h1><span>Featured Video</span></h1>
                            </div>
                            <div class="news-post video-post">
                                <img alt="" src="{{ asset('frontend/upload')}}/news-posts/video-sidebar.jpg">
                                <a href="https://www.youtube.com/watch?v=LL59es7iy8Q" class="video-link"><i class="fa fa-play-circle-o"></i></a>
                                <div class="hover-box">
                                    <h2><a href="single-post.php">Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. </a></h2>
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                                    </ul>
                                </div>
                                <p></p>
                            </div>
                            <p>এমপিওভুক্তির নতুন তালিকায় ২৬২৭ প্রতিষ্ঠান. Donec nec justo eget felis facilisis. </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="border"></div>

        <div class="advertisement">
            <div class="desktop-advert">
                <img src="{{ asset('frontend/upload')}}/addsense/728x90-white.gif" alt="">
            </div>
            <div class="tablet-advert">
                <img src="{{ asset('frontend/upload')}}/addsense/468x60-white.jpg" alt="">
            </div>
            <div class="mobile-advert">
                <img src="{{ asset('frontend/upload')}}/addsense/468x60-white.jpg" alt="">
            </div>
        </div>
        <div class="container section-body">

            <div class="row">

                <div class="col-md-2 ">

                    <!-- sidebar -->
                    <div class="sidebar small-sidebar">

                        <div class="widget review-widget">
                            <h1>টপ ভিউস </h1>
                            <ul class="review-posts-list">
                                @foreach($top_views as $top_news)
                                <li>
                                    <img src="{{ asset('upload/images/thumb_img/'. $top_news->source_path)}}" alt="">
                                    <h2><a href="{{route('news_details', $top_news->news_slug)}}">{{str_limit($top_news->news_title, 50)}}</a></h2>

                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="advertisement">
                            <div class="desktop-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/160x600.jpg" alt="">
                            </div>
                            <div class="tablet-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/160x600.jpg" alt="">
                            </div>
                            <div class="mobile-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/160x600.jpg" alt="">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-7 col-sm-8 divrigth_border">
                    <!-- world news content -->
                        <!-- grid box -->
                        <div class="grid-box owl-wrapper">
                            <div class="title-section">
                                <h1><span>আন্তর্জাতিক</span></h1>
                            </div>

                            <div class="row">
                             <?php $i= 1; ?>
                             @foreach($get_world_news as $world_news)
                                @if($i == 1)
                                <div class="col-md-6">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $world_news->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">
                                                    <h2><a href="{{route('news_details', $world_news->news_slug)}}">{{str_limit($world_news->news_title, 50)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($world_news->created_at)->format('d M, Y')}}</li>
                                                        <li><a href="#"><i class="fa fa-tags"></i>{{$world_news->subcategory_bd}}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($i==2)
                                <div class="col-md-6">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $world_news->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">

                                                    <h2><a href="{{route('news_details', $world_news->news_slug)}}">{{str_limit($world_news->news_title, 40)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($world_news->created_at)->format('d M, Y')}}</li>
                                                        <li><a href="#"><i class="fa fa-tags"></i>{{$world_news->subcategory_bd}}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <ul class="list-posts">
                                        <li>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $world_news->news_slug)}}">{{str_limit($world_news->news_title, 50)}} </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($world_news->created_at)->format('d M, Y')}}</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                              <?php $i++;?>
                             @endforeach
                            </div>

                            <div class="center-button">
                                <a href="#"><i class="fa fa-refresh"></i> সব খবর</a>
                            </div>

                        </div>
                        <!-- End grid box -->

                        <!-- slider-caption-box -->
                        <div class="slider-caption-box">
                            <div class="slider-holder">
                                <ul class="slider-call">
                                    @foreach($slider_box_news as $slider_news)
                                        <li>
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $slider_news->source_path)}}" alt="">
                                                <div class="hover-box">
                                                    <div class="inner-hover">
                                                        <h2><a href="{{route('news_details', $slider_news->news_slug)}}">{{str_limit($slider_news->news_title, 50)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($slider_news->created_at)->format('d M, Y')}}</li>
                                                            <li><a href="#"><i class="fa fa-tags"></i> {{$slider_news->category_bd}}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div id="bx-pager">
                            <?php $i = 0;?>
                                @foreach($slider_box_news as $slider_news)
                                <a data-slide-index="{{$i}}" href="#">
                                    {{str_limit($slider_news->news_title, 50)}}
                                </a>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        </div>
                        <!-- End slider-caption-box -->

                        <!-- grid box -->
                        <div class="grid-box">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="title-section">
                                        <h1><span>তথ্যপ্রযুক্তি</span></h1>
                                    </div>

                                    <ul class="list-posts">
                                        @foreach($get_technology_news as $technology_news)
                                        <li>
                                            <img src="{{ asset('upload/images/thumb_img/'. $technology_news->source_path)}}" alt="">
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $technology_news->news_slug)}}">{{str_limit($technology_news->news_title, 50)}}</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($technology_news->created_at)->format('d M, Y')}}</li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-6">

                                    <div class="title-section">
                                        <h1><span>দুর্ঘটনা</span></h1>
                                    </div>

                                    <ul class="list-posts">
                                        @foreach($get_bussines_news as $bussines_news)
                                            <li>
                                                <img src="{{ asset('upload/images/thumb_img/'. $bussines_news->source_path)}}" alt="">
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $bussines_news->news_slug)}}">{{str_limit($bussines_news->news_title, 50)}}</a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($bussines_news->created_at)->format('d M, Y')}}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                            </div>

                        </div>
                        <!-- End grid box -->

                    <div class="grid-box">

                        <div class="advertisement">
                            <div class="desktop-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add.jpg" alt="">
                            </div>
                            <div class="tablet-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add.jpg" alt="">
                            </div>
                            <div class="mobile-advert">
                                <img src="{{ asset('frontend/upload')}}/addsense/add.jpg" alt="">
                            </div>
                        </div>

                    </div>

                    <!-- End world new -->

                </div>

                <div class="col-md-3 col-sm-4">

                    <!-- sidebar -->
                    <div class="sidebar large-sidebar">


                        <div class="advertisement">
                            <div class="desktop-advert">
                                <span>Advertisement</span>
                                <img src="{{ asset('frontend/upload')}}/addsense/250x250.jpg" alt="">
                            </div>
                            <div class="tablet-advert">
                                <span>Advertisement</span>
                                <img src="{{ asset('frontend/upload')}}/addsense/200x200.jpg" alt="">
                            </div>
                            <div class="mobile-advert">
                                <span>Advertisement</span>
                                <img src="{{ asset('frontend/upload')}}/addsense/300x250.jpg" alt="">
                            </div>
                        </div>

                        <div class="widget features-slide-widget">
                            <div class="title-section">
                                <h1><span>আবহাওয়া</span></h1>
                            </div>
                            <ul class="list-posts">
                                @foreach($sidebar_news_first as $sitebar_first)
                                    <li>
                                        <img src="{{ asset('upload/images/thumb_img/'. $sitebar_first->source_path)}}" alt="">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $sitebar_first->news_slug)}}">{{$sitebar_first->news_title}}</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($sitebar_first->created_at)->format('d M, Y')}}</li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget review-widget">

                            <div class="title-section">
                                <h1>জাগো  মানবতা </h1>
                            </div>
                            <ul class="review-posts-list">
                                <?php $i = 1; ?>
                                @foreach($top_views as $top_news)
                                    @if($i == 1)
                                    <li>
                                        <img src="{{ asset('upload/images/thumb_img/'. $top_news->source_path)}}" alt="">
                                        <h2><a href="{{route('news_details', $top_news->news_slug)}}">{{str_limit($top_news->news_title, 50)}}</a></h2>
                                    </li>
                                    @else
                                        <li>
                                            <h2><a href="{{route('news_details', $top_news->news_slug)}}">{{str_limit($top_news->news_title, 50)}}</a></h2>
                                        </li>
                                    @endif
                                <?php $i++; ?>
                                @endforeach
                            </ul>

                        </div>

                    </div>
                    <!-- End sidebar -->

                </div>

            </div>

        </div>
    </section >
    <!-- End block-wrapper-section -->

    <!-- heading-news-section2
        ================================================== -->
    <section class="heading-news2">

        <div class="container">

                <div class="row" style="color: #fff">
                    <div class="col-md-8">
                        <div class="title-section">
                            <h1><span>ছবির কথা</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_picture_voice as $picture_voice)

                                @if($i==1)
                                <div class="col-md-6" style="margin-bottom: 15px">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img_box/'. $picture_voice->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">
                                                    <h2><a  style="color: #fff" href="{{route('news_details', $picture_voice->news_slug)}}">{{str_limit($picture_voice->news_title, 50)}}</a></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($i==2)
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img_box/'. $picture_voice->source_path)}}" alt="">
                                                <div class="hover-box">
                                                    <div class="inner-hover">
                                                        <h2><a  style="color: #fff" href="{{route('news_details', $picture_voice->news_slug)}}">{{str_limit($picture_voice->news_title, 50)}}</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-3">
                                    <div class="item news-post standard-post">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $picture_voice->source_path)}}" alt="">
                                        </div>
                                        <div class="post-content">
                                            <h2><a  style="color: #fff" href="{{route('news_details', $picture_voice->news_slug)}}">{{str_limit($picture_voice->news_title, 50)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="title-section">
                            <h1><span>ভিজ্যুয়াল গ্যালারি </span></h1>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($get_visual_gallery as $visual_gallery)
                            @if($i == 1)
                        <div class="item news-post standard-post">
                            <div class="post-gallery">
                                <img src="{{ asset('upload/images/thumb_img_box/'. $visual_gallery->source_path)}}" alt="">
                            </div>
                            <div class="post-content">
                                <h2><a  style="color: #fff" href="{{route('news_details', $visual_gallery->news_slug)}}">{{str_limit($visual_gallery->news_title, 50)}}</a></h2>
                            </div>
                        </div>
                        @else
                        <ul class="list-posts" style="background-color: transparent;">
                            <li>
                                <img src="{{ asset('upload/images/thumb_img/'. $visual_gallery->source_path)}}" alt="">
                                <div class="post-content">
                                    <h2><a  style="color: #fff" href="{{route('news_details', $visual_gallery->news_slug)}}">{{str_limit($visual_gallery->news_title, 50)}}</a></h2>
                                </div>
                            </li>
                        </ul>
                            @endif
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>

        </div>

    </section>
    <!-- End heading-news-section -->
    <section class="block-wrapper">
        <div class="container section-body">
            <div class="row">
                <div class="col-md-9 divrigth_border">

                    <div class="title-section">
                        <h1><span>দেশজুড়ে </span></h1>
                    </div>


                            <?php $i = 1;?>
                            @foreach($recent_section_news as $section_news)
                                @if($i==1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="news-post image-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img_box/'. $section_news->source_path)}}"  alt="">
                                                    <div class="hover-box">
                                                        <div class="inner-hover">
                                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{str_limit($section_news->news_title, 60)}} </a></h2>
                                                            <ul class="post-tags">
                                                                <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($section_news->created_at)->format('d M, Y')}}</li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($i==2)
                                            <div class="col-md-6">
                                                <div class="row">
                                                    @endif
                                                    @if($i>1 && $i<=5)
                                                        <div class="col-md-12 col-sm-12">
                                                            <ul class="list-posts">
                                                                <li>
                                                                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">
                                                                    <div class="post-content">
                                                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{str_limit($section_news->news_title, 80)}}</a></h2>
                                                                        <ul class="post-tags">
                                                                            <li><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                                                                            <li><i class="fa fa-tags"></i>{{$section_news->subcategory_bd}}</li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    @if($i==5)</div>
                                            </div>
                                    </div>
                                @endif
                                @if($i==6)
                                    <div class="row">
                                        @endif
                                        @if($i>=7)
                                            <div class="col-md-3">
                                                <div class="news-post standard-post2">
                                                    <div class="post-gallery">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">

                                                    </div>
                                                    <div class="post-title">
                                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{str_limit($section_news->news_title, 20)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($section_news->created_at)->format('d M, Y')}}</li>

                                                            <li><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <?php $i++; ?>
                                        @endforeach
                                    </div>

                </div>
                <div class="col-md-3 map">
                    <div class="title-section">
                            <h1><span>এক ক্লিকে বিভাগের খবর</span></h1>
                        </div>
                    <img src="{{ asset('frontend')}}/images/bangladesh-map.jpg">
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                        <form action="#" method="get">
                        <div class="row form-group">
                        <div class="col-sm-6">
                        <label for="division" class="sr-only">বিভাগ</label>
                        <select class="form-control" name="division" id="division">
                        <option>--বিভাগ--</option>
                        <option data-id="2" value="barisal">বরিশাল</option>
                        <option data-id="3" value="chittagong">চট্টগ্রাম</option>
                        <option data-id="4" value="dhaka">ঢাকা</option>
                        <option data-id="5" value="khulna">খুলনা</option>
                        <option data-id="6" value="rajshahi">রাজশাহী</option>
                        <option data-id="7" value="sylhet">সিলেট</option>
                        <option data-id="8" value="rangpur">রংপুর</option>
                        <option data-id="9" value="mymensingh">ময়মনসিংহ</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <label for="district" class="sr-only">জেলা</label>
                        <select class="form-control" name="district" id="district"></select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                        <label for="upozilla" class="sr-only">উপজেলা</label>
                        <select class="form-control" name="upozilla" id="upozilla"></select>
                        </div>
                        <div class="col-sm-6">
                        <button type="submit" class="btn btn-danger btn-block">অনুসন্ধান
                        করুন
                        </button>
                        </div>
                        </div>
                        </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>

    </section>
    <div class="border"></div>
    <section class="block-wrapper lifestyle">
        <div class="container section-body">
            <div class="row">

                <div class="col-md-3">
                    <div class="title-section">
                        <h1><span class="world">লাইফ স্টাইল</span></h1>
                    </div>

                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($get_life_style as $life_style)
                            @if($i == 1)
                            <div class="col-md-12">
                                <div class="news-post image-post2">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $life_style->source_path)}}" alt="">
                                        <div class="hover-box">
                                            <div class="inner-hover">
                                                <h2><a href="{{route('news_details', $life_style->news_slug)}}">{{str_limit($life_style->news_title, 80)}}</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($life_style->created_at)->format('d M, Y')}}</li>
                                                    <li><i class="fa fa-eye"></i>0</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-12">
                            <div class="item news-post standard-post">
                                <div class="post-content">
                                    <h2><a href="{{route('news_details', $life_style->news_slug)}}">{{str_limit($life_style->news_title, 80)}}</a></h2>
                                </div>
                            </div>
                        </div>
                            @endif
                     <?php $i++; ?>
                    @endforeach
                    </div>
                    <div class="center-button">
                        <a href="#"><i class="fa fa-refresh"></i> সব খবর</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title-section">
                        <h1><span class="travel">প্রবাস</span></h1>
                    </div>

                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($get_provash_news as $provash_news)
                            @if($i == 1)
                                <div class="col-md-12">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $provash_news->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">
                                                    <h2><a href="{{route('news_details', $provash_news->news_slug)}}">{{str_limit($provash_news->news_title, 80)}}</a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($provash_news->created_at)->format('d M, Y')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="item news-post standard-post">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $provash_news->news_slug)}}">{{str_limit($provash_news->news_title, 80)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                    <div class="center-button">
                        <a href="#"><i class="fa fa-refresh"></i> সব খবর</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title-section">
                        <h1><span class="travel">ফিচার</span></h1>
                    </div>

                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($get_feature_news as $feature_news)
                            @if($i == 1)
                                <div class="col-md-12">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $feature_news->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">
                                                    <h2><a href="{{route('news_details', $feature_news->news_slug)}}">{{str_limit($feature_news->news_title, 80)}}</a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($feature_news->created_at)->format('d M, Y')}}</li>
                                                        <li><i class="fa fa-eye"></i>0</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="item news-post standard-post">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $feature_news->news_slug)}}">{{str_limit($feature_news->news_title, 80)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                    <div class="center-button">
                        <a href="#"><i class="fa fa-refresh"></i> সব খবর</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title-section">
                        <h1><span class="travel">ভ্রমণ</span></h1>
                    </div>

                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($get_travel_news as $travel_news )
                            @if($i == 1)
                                <div class="col-md-12">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $travel_news->source_path)}}" alt="">
                                            <div class="hover-box">
                                                <div class="inner-hover">
                                                    <h2><a href="{{route('news_details', $travel_news->news_slug)}}">{{str_limit($travel_news->news_title, 80)}}</a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($travel_news->created_at)->format('d M, Y')}}</li>
                                                        <li><i class="fa fa-eye"></i>0</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="item news-post standard-post">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $travel_news->news_slug)}}">{{str_limit($travel_news->news_title, 80)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                    <div class="center-button">
                        <a href="#"><i class="fa fa-refresh"></i> সব খবর</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
