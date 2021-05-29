@extends('frontend.en.layouts.master')
@section('title', Config::get('siteSetting.title'))
@section('MetaTag')
    <meta name="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">


    <meta name="keywords" content="bdtype, bangla news, current News, bangla newspaper, bangladesh newspaper, online paper, bangladeshi newspaper, bangla news paper, bangladesh newspapers, newspaper, all bangla news paper, bd news paper, news paper, bangladesh news paper, daily, bangla newspaper, daily news paper, bangladeshi news paper, bangla paper, all bangla newspaper, bangladesh news, daily newspaper, web design, bangla paper, add post, how to use wordpress, wordpress add post, wordpress tutorials, adding wordpress post, wordpress posts, wordpress, wordpress tutorial, word press basics, wordpress basics, marketing, blogger (website), blog (industry), web design (interest), create wordpress, wordpress blog entry, wordpress blog, word press, wordpress (blogger), daily newspaper, bangladesh news, all bangla newspaper, wordpress user guide, bangladeshi news paper, daily news paper, daily, bangladesh news paper, news paper, bd news paper, all bangla news paper, newspaper, bangladesh newspapers, bangla news paper, bangladeshi newspaper, online paper, bangladesh newspaper, bangla newspaper, current news" />

    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

        <!-- Schema.org for Google -->

    <meta itemprop="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta itemprop="image" content="{{ asset('frontend')}}/images/logo-black.png">

        <!-- Twitter -->
    <meta name="twitter:card" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, , Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:title" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, , Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Bdtype">
    <meta name="twitter:image:src" content="{{ asset('frontend')}}/images/logo-black.png">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">
    <meta name="og:image" content="{{ asset('frontend')}}/images/logo-black.png">
     <meta name="og:url" content="{{ url()->full() }}">
    <meta name="og:site_name" content="Bdtype">
    <meta name="og:locale" content="en">
    <meta name="og:type" content="website">
    <meta name="fb:admins" content="1323213265465">
    <meta name="fb:app_id" content="13212465454">
    <meta name="og:type" content="article">


@endsection

@section('content')
    <?PHP

    $get_ads = App\Models\Addvertisement::where('page', 'home')->get();
    $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
    foreach ($get_ads as $ads){
        if($ads->position == 1){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 2){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 3){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 5){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
    }
    function banglaDate($date){

        return Carbon\Carbon::parse($date)->format('d F, Y');
       
    }
    ?>

    <!-- block-wrapper-section -->
    <div class="block-wrapper">
        @include('frontend.en.breaking-news')
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-9  section-body divrigth_border" id="sticky-conent">

                        <div class="row">
                            <div class="grid-box">

                                <?php $i = 1;?>
                                @foreach($recent_section_news as $section_news)
                                    @if($i==1)

                                        <div class="col-md-6 col-sm-6">
                                            <div class="news-post standard-post2 ">
                                                <a href="{{route('news_details', $section_news->news_slug)}}">
                                                    <div class="post-gallery">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">
                                                        @if($section_news->type == 3)
                                                            <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                        @elseif($section_news->type == 4)
                                                            <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                        @else @endif
                                                    </div>
                                                    <div class="post-title box_title">
                                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 90)}} </a></h2>
                                                        <span>{!!Str::limit(strip_tags($section_news->news_dsc), 150)!!}</span>

                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-3 col-xs-6 col-sm-3">
                                            <div class="news-post standard-post2">
                                                <a href="{{route('news_details', $section_news->news_slug)}}">
                                                    <div class="post-gallery">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">
                                                        @if($section_news->type == 3)
                                                            <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                        @elseif($section_news->type == 4)
                                                            <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                        @else @endif
                                                    </div>
                                                    <div class="post-title">
                                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i>{{$section_news->category_en}}</li>

                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <?php $i++;?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 section-body" id="sticky-conent">
                        <div class="widget features-slide-widget">
                            <ul class="list-posts">
                                @foreach($sidebar_news_first as $sitebar_first)
                                    <li>
                                        <img src="{{ asset('upload/images/thumb_img/'. $sitebar_first->source_path)}}" alt="">
                                        @if($sitebar_first->type == 3)
                                            <a class="play-link" href="{{route('news_details', $sitebar_first->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                        @elseif($sitebar_first->type == 4)
                                            <a class="play-link" href="{{route('news_details', $sitebar_first->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                        @else
                                        @endif
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $sitebar_first->news_slug)}}">{{$sitebar_first->news_title}}</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($sitebar_first->publish_date)}}</li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br/>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-9  section-body divrigth_border" id="sticky-conent">


                        <div class="row">

                            <section class="features-today second-style">
                                <div class="title-section">
                                    <h1><span> Discussed </span></h1>
                                </div>

                                <div class="features-today-box owl-wrapper">
                                    <div class="owl-carousel" data-num="4">
                                        @foreach($special_reports as $special_report)
                                            <div class="item news-post standard-post">
                                                <a href="{{route('news_details', $special_report->news_slug)}}">
                                                    <div class="post-gallery" style="padding: 0px 10px;">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $special_report->source_path)}}" alt="">
                                                        @if($special_report->type == 3)
                                                            <a class="play-link" href="{{route('news_details', $special_report->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                        @elseif($special_report->type == 4)
                                                            <a class="play-link" href="{{route('news_details', $special_report->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                        @else @endif
                                                    </div>
                                                    <div class="post-content" style="padding: 0px 10px;">
                                                        <h2><a href="{{route('news_details', $special_report->news_slug)}}">{{Str::limit($special_report->news_title, 45)}}</a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i>{{$special_report->category_en}}</li>

                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($special_report->publish_date)}}</li>

                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </section>

                        </div>


                        <div class="row">
                            <div class="title-section">
                                <h1><span>National</span></h1>
                            </div>
                            <?php $i = 1; ?>
                            @foreach($get_national_news as $national_news)
                                @if($i == 1)
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $national_news->source_path)}}" alt="">
                                                @if($national_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($national_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="hover-box">
                                                    <div class="inner-hover ">

                                                        <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($national_news->publish_date)}}</li>

                                                            <li><i class="fa fa-tags"></i>{{$national_news->subcategory_en}}</li>
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
                                                @if($national_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($national_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="hover-box">
                                                    <div class="inner-hover">
                                                        <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($national_news->publish_date)}}</li>

                                                            <li><i class="fa fa-tags"></i>{{$national_news->subcategory_en}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3 col-xs-6">

                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $national_news->source_path)}}" alt="">
                                                @if($national_news->type == 3)
                                                    <a class="play-link" class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($national_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $national_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $national_news->news_slug)}}">{{$national_news->news_title}}</a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($national_news->publish_date)}}</li>
                                                    <li ><i class="fa fa-eye"></i>{{$national_news->subcategory_en}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>
                        <div class="border"></div>
                        <div class="row">
                            <div class="title-section">
                                <h1><span>International</span></h1>
                            </div>
                            <?php $i = 1; ?>
                            @foreach($get_world_news as $world_news)
                                @if($i == 1)
                                    <div class="col-md-6">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $world_news->source_path)}}" alt="">
                                                @if($world_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $world_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($world_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $world_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <a class="category-post tech" href="#">{{$world_news->subcategory_en}}</a>
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $world_news->news_slug)}}">{{$world_news->news_title}}</a></h2>
                                                <span>{!!Str::limit(strip_tags($world_news->news_dsc), 150)!!}</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <ul class="list-posts">
                                            <li>
                                                <img src="{{ asset('upload/images/thumb_img/'. $world_news->source_path)}}" alt="">
                                                @if($world_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $world_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($world_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $world_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $world_news->news_slug)}}">{{Str::limit($world_news->news_title, 50)}}</a></h2>

                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i>{{$world_news->subcategory_en}}</li>
                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($world_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach

                        </div>
                        <div class="border"></div>
                        <div class="row">
                            <div class="title-section">
                                <h1><span>Sports</span></h1>
                            </div>
                            <div class="grid-box">

                                <?php $i = 1;?>
                                @foreach($get_sport_news as $sport_news)
                                    @if($i==1)

                                        <div class="col-md-6 col-sm-6">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $sport_news->source_path)}}" alt="">
                                                    @if($sport_news->type == 3)
                                                        <a class="play-link" class="play-link" href="{{route('news_details', $sport_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                    @elseif($sport_news->type == 4)
                                                        <a class="play-link" href="{{route('news_details', $sport_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                    @else @endif
                                                </div>
                                                <div class="post-title box_title">
                                                    <h2><a href="{{route('news_details', $sport_news->news_slug)}}">{{Str::limit($sport_news->news_title, 80)}} </a></h2>
                                                    <span>{!!Str::limit(strip_tags($sport_news->news_dsc), 150)!!}</span>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-3 col-xs-6 col-sm-3">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $sport_news->source_path)}}" alt="">
                                                    @if($sport_news->type == 3)
                                                        <a class="play-link" href="{{route('news_details', $sport_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                    @elseif($sport_news->type == 4)
                                                        <a class="play-link" href="{{route('news_details', $sport_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                    @else @endif

                                                </div>
                                                <div class="post-title">
                                                    <h2><a href="{{route('news_details', $sport_news->news_slug)}}">{{Str::limit($sport_news->news_title, 40)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i>{{$sport_news->subcategory_en}}</li>

                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($sport_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                    <?php $i++;?>
                                @endforeach
                            </div>
                        </div>

                        <div class="border"></div>

                        <div class="advertisement">
                            <div class="desktop-advert">
                                {!! $topOfNews !!}
                            </div>
                            <div class="tablet-advert">
                                {!! $topOfNews !!}
                            </div>
                            <div class="mobile-advert">
                                {!! $topOfNews !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 section-body" id="sticky-conent">
                        <!-- sidebar -->
                        <div class="sidebar large-sidebar">
                            @include('frontend.en.layouts.sitebar')
                           
                            <div class="widget features-slide-widget">
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
                            </div>

                            <div class="widget features-slide-widget">
                                <div class="title-section">
                                    <h1><span>Vote online</span></h1>
                                </div>
                                 
                                    <div class="" style="height: 235px;background: #000; padding: 3px 10px;">
                                        
                                
                                    <form action="{{url('/')}}" method="get" class="">

                                       <h2 style="font-size: 18px;line-height: initial;"><a href="{{url('poll')}}">Do you think the decision to increase the ticket price for entering the Dhaka International Trade Fair is logical?</a></h2>
                                       <p style="color:#fff;">
                                        <input type="radio" name="poll"> Yes 
                                        <input type="radio" name="poll"> No
                                        <input type="radio" name="poll"> No Comments
                                    </p>
                                    <p><button class="btn btn-info">Vote up</button></p>
                                        <ul class="post-tags">
                                            <li><i class="fa fa-eye"></i>538</li>

                                            <li> 330 people voted</li>
                                        </ul>
                                    </form>
                                </div>
                                
                            </div>

                            <div class="widget features-slide-widget">
                                <div class="title-section">
                                    <h1><span>Live TV</span></h1>
                                </div>
                                <ul class="list-posts">
                                    @foreach($get_live_tv as $live_tv)
                                        <li>
                                            <img src="{{ asset('upload/images/thumb_img/'. $live_tv->source_path)}}" alt="">
                                             
                                            <a class="play-link" href="{{route('news_details', $live_tv->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                            
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $live_tv->news_slug)}}">{{Str::limit($live_tv->news_title, 60)}}</a></h2>
                                                <ul class="post-tags">
                                                     <li><i class="fa fa-eye"></i>{{$live_tv->view_counts}}</li>
                                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($live_tv->publish_date)}}</li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                        <!-- End sidebar -->
                    </div>
                </div>
            </div>
        </section>
        <div class="border"></div>
        <section>
            <div class="container section-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title-section">
                            <h1><span>Entertainment</span></h1>
                        </div>

                        <div class="row">
                            <?php $i= 1; ?>
                            @foreach($entertainment_news as $show_news)
                                @if($i == 1)
                                    <div class="col-md-6">
                                        <div class="news-post image-post3">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                @if($show_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($show_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="hover-box">
                                                <div class="inner-hover ">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{$show_news->news_title}}</a></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <p style="padding-top: 5px">{!!Str::limit(strip_tags($show_news->news_dsc), 105)!!}</p>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <ul class="list-posts">
                                            <li>
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                @if($show_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($show_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 60)}}</a></h2>
                                                    <ul class="post-tags">

                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="title-section">
                            <h1><span>Crime</span></h1>
                        </div>
                        <div class="row">

                            <?php $i= 1; ?>
                            @foreach($crime_posts as $show_news)
                                @if($i == 1)
                                    <div class="col-md-6">
                                        <div class="news-post image-post3">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                @if($show_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($show_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="hover-box">
                                                <div class="inner-hover ">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{$show_news->news_title}}</a></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <p style="padding-top: 5px">{{Str::limit(strip_tags($show_news->news_dsc), 105)}}</p>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <ul class="list-posts">
                                            <li>
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                @if($show_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($show_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 50)}}</a></h2>
                                                    <ul class="post-tags">

                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <div class="border"></div>
        <section>
            <div class="container section-body">
                <div class="row">
                    <div class="col-md-3 col-xs-6 divrigth_border">

                        <div class="title-section">
                            <h1><span>Technology</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_technology_news as $technology_news)

                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $technology_news->source_path)}}" alt="">
                                                @if($technology_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $technology_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($technology_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $technology_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>

                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $technology_news->news_slug)}}">{{Str::limit($technology_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $technology_news->source_path)}}" alt="">
                                                @if($technology_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $technology_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($technology_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $technology_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $technology_news->news_slug)}}">{{Str::limit($technology_news->news_title, 50)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6 divrigth_border">

                        <div class="title-section">
                            <h1><span>Accidente</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_accidente_news as $accidente_news)
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $accidente_news->source_path)}}" alt="">
                                                @if($accidente_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $accidente_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($accidente_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $accidente_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>

                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $accidente_news->news_slug)}}">{{Str::limit($accidente_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $accidente_news->source_path)}}" alt="">
                                                @if($accidente_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $accidente_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($accidente_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $accidente_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $accidente_news->news_slug)}}">{{Str::limit($accidente_news->news_title, 50)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6 divrigth_border">

                        <div class="title-section">
                            <h1><span>Educations</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_education_news as $education_news)
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $education_news->source_path)}}" alt="">
                                                @if($education_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $education_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($education_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $education_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>

                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $education_news->news_slug)}}">{{Str::limit($education_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $education_news->source_path)}}" alt="">
                                                @if($education_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $education_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($education_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $education_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $education_news->news_slug)}}">{{Str::limit($education_news->news_title, 50)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <div class="title-section">
                            <h1><span>Health</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_health_news as $health_news)
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $health_news->source_path)}}" alt="">
                                                @if($health_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $health_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($health_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $health_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $health_news->news_slug)}}">{{Str::limit($health_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $health_news->source_path)}}" alt="">
                                                @if($health_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $health_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($health_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $health_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $health_news->news_slug)}}">{{Str::limit($health_news->news_title, 50)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
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
                    </div>
                </div>
            </div>
        </section>
        <section class="heading-news2 gallery">

            <div class="container">

                <div class="row" style="color: #fff">
                    <div class="col-md-8">
                        <div class="title-section">
                            <h1><span style="color: #fff;background: #222;border-bottom: 1px solid #f44336;">Image Gallery</span></h1>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="image-slider snd-size">

                                    <ul class="bxslider">
                                        <?php $i = 1; ?>
                                        @foreach($get_picture_voice as $picture_voice)

                                            @if($i<=3)
                                            <li>
                                                <div class="news-post image-post">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $picture_voice->source_path)}}" alt="">
                                                    <div class="hover-box">
                                                        <div class="inner-hover">

                                                            <h2><a href="{{route('news_details', $picture_voice->news_slug)}}">{{Str::limit($picture_voice->news_title, 50)}}</a></h2>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                         @if($i==3)
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @else
                                <div class="col-md-3 col-xs-6">
                                    <div class="item news-post standard-post">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $picture_voice->source_path)}}" alt="">
                                        </div>
                                        <div class="post-content" style="padding: 7px 5px;">
                                            <h2><a  style="color: #fff" href="{{route('news_details', $picture_voice->news_slug)}}">{{Str::limit($picture_voice->news_title, 50)}}</a></h2>
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
                             <h1><span style="color: #fff;background: #222;border-bottom: 1px solid #f44336;">Video Gallery</span></h1>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($get_visual_gallery as $visual_gallery)
                            @if($i == 1)
                                <div class="news-post image-post default-size">
                                    <img src="{{ asset('upload/images/thumb_img/'. $visual_gallery->source_path)}}" alt="">
                                    <a class="play-link" href="{{route('news_details', $visual_gallery->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                    <div class="hover-box">
                                        <div class="inner-hover">
                                            <h2><a href="{{route('news_details', $visual_gallery->news_slug)}}">{{Str::limit($visual_gallery->news_title, 50)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <ul class="list-posts" style="background-color: transparent;">
                                    <li>
                                        <img src="{{ asset('upload/images/thumb_img/'. $visual_gallery->source_path)}}" alt="">
                                        <a class="play-link" href="{{route('news_details', $visual_gallery->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                        <div class="post-content">
                                            <h2><a  style="color: #fff" href="{{route('news_details', $visual_gallery->news_slug)}}">{{Str::limit($visual_gallery->news_title, 50)}}</a></h2>
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
        <section>
            <div class="container section-body">
                <div class="row">
                    <div class="col-md-9 divrigth_border" id="sticky-conent">

                        <div class="title-section">
                            <h1><span>All over the country </span></h1>
                        </div>

                        <div class="row">
                            <?php $i = 1;?>
                            @foreach($desh_jure_news as $show_news)
                                @if($i==1)

                                    <div class="col-md-6">
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}"  alt="">
                                                <div class="hover-box">
                                                    @if($show_news->type == 3)
                                                        <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                    @elseif($show_news->type == 4)
                                                        <a class="play-link" href="{{route('news_details', $show_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                    @else @endif
                                                    <div class="inner-hover">
                                                        <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 60)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i>{{ ($show_news->subcategory) ? $show_news->subcategory_en : $show_news->category_en}}</li>
                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($i>1 && $i<=6)
                                    <div class="col-md-6">
                                        <ul class="list-posts">
                                            <li>
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 40)}}</a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i>{{$show_news->subcategory_en}}</li>
                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="col-md-3 col-xs-6">
                                        <div class="news-post standard-post2">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">

                                            </div>
                                            <div class="post-title">
                                                <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 60)}} </a></h2>
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-tags"></i>{{$show_news->category_en}}</li>
                                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($show_news->publish_date)}}</li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3  map" id="sticky-conent">
                        <div class="title-section">
                            <h1><span>All news in one click</span></h1>
                        </div>
                        <div class="map">
                            @include('frontend.map');
                        </div>
                        <br/>
                        <form action="{{route('category', ['deshjure'])}}" method="get">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="division" class="sr-only">Division</label>
                                    <select class="form-control" name="division" id="division">
                                        <option>--division--</option>
                                        <option data-id="2" value="barisal">barisal</option>
                                        <option data-id="3" value="chittagong">chittagong</option>
                                        <option data-id="4" value="dhaka">dhaka</option>
                                        <option data-id="5" value="khulna">khulna</option>
                                        <option data-id="6" value="rajshahi">rajshahi</option>
                                        <option data-id="7" value="sylhet">sylhet</option>
                                        <option data-id="8" value="rangpur">rangpur</option>
                                        <option data-id="9" value="mymensingh">mymensingh</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="district" class="sr-only">Zilla</label>
                                    <select class="form-control" name="district" id="district"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="upozilla" class="sr-only">Upzilla</label>
                                    <select class="form-control" name="upozilla" id="upozilla"></select>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-danger btn-block">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section><br/>

        <section class="lifestyle">
            <div class="container section-body">
                <div class="row">
                    <div class="col-md-3 col-xs-6 divrigth_border">
                        <div class="title-section">
                            <h1><span class="travel">Politics</span></h1>
                        </div>
                        @if(count($get_politics)>0)
                            <div class="row">
                                <?php $i = 1; ?>
                                @foreach($get_politics as $show_news)
                                    @if($i == 1)
                                        <div class="col-md-12">
                                            <div class="item news-post standard-post">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $show_news->source_path)}}" alt="">
                                                </div>
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 80)}}</a></h2>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="item news-post standard-post">
                                                <div class="post-content">
                                                    <h2><a href="{{route('news_details', $show_news->news_slug)}}">{{Str::limit($show_news->news_title, 80)}}</a></h2>
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
                        @endif
                    </div>
                    <div class="col-md-3 col-xs-6 divrigth_border">
                        <div class="title-section">
                            <h1><span class="world">Life Style</span></h1>
                        </div>

                        <div class="row">
                            <?php $i = 1; ?>
                            @if(count($get_life_style)>0)
                            @foreach($get_life_style as $life_style)
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $life_style->source_path)}}" alt="">
                                            </div>
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $life_style->news_slug)}}">{{Str::limit($life_style->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $life_style->news_slug)}}">{{Str::limit($life_style->news_title, 80)}}</a></h2>
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
                        @endif
                    </div>
                    <div class="col-md-3 col-xs-6 divrigth_border">
                        <div class="title-section">
                            <h1><span class="travel">Dear expatriate</span></h1>
                        </div>

                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($get_provash_news as $provash_news)
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $provash_news->source_path)}}" alt="">
                                            </div>

                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $life_style->news_slug)}}">{{Str::limit($provash_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $provash_news->news_slug)}}">{{Str::limit($provash_news->news_title, 80)}}</a></h2>
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

                    <div class="col-md-3 col-xs-6">
                        <div class="title-section">
                            <h1><span class="travel">Religion and life</span></h1>
                        </div>
                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach($religion_news as $travel_news )
                                @if($i == 1)
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $travel_news->source_path)}}" alt="">

                                            </div>

                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $travel_news->news_slug)}}">{{Str::limit($travel_news->news_title, 80)}}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="item news-post standard-post">
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $travel_news->news_slug)}}">{{Str::limit($travel_news->news_title, 80)}}</a></h2>
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
        <section>
            <div class="row">
                <div class="col-md-12">
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
            </div>
        </section>
    </div>
@endsection
