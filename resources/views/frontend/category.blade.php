@extends('frontend.layouts.master')
@section('title') @if($subchild_cat) {{ $subchild_cat->name_bd }} | @endif @if($child_cat) {{ $child_cat->name_bd }} | @endif @if($subcategory) {{ $subcategory->subcategory_bd}} | @endif  {{$category->category_bd}} | {{Config::get('siteSetting.site_name')}}
@endsection
@php

    if($subcategory) { $meta_title = $subcategory->meta_title; $meta_keywords = $subcategory->keywords; $meta_tags = $subcategory->meta_tags; $meta_desciption = $subcategory->meta_desciption;}
    else{
       $meta_title = $category->meta_title; $meta_keywords = $category->keywords; $meta_tags = $category->meta_tags; $meta_desciption = $category->meta_desciption;
    }
    @endphp
@section('MetaTag')
    <meta name="title" content="{{ $meta_title }}">
    <meta name="description" content="{{$meta_desciption}}">
    <meta name="keywords" content="{{$meta_keywords}}" />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desciption}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:type" content="article">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{$meta_title}}">
    <meta itemprop="description" content="{{$meta_desciption}}">
    <meta itemprop="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$meta_title}}">
    <meta name="twitter:title" content="{{$meta_title}}">
    <meta name="twitter:description" content="{{$meta_desciption}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection

@section('content')
<?PHP
        $get_ads = App\Models\Addvertisement::where('page', 'category')->where('status', 1)->get();
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
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>
    <!-- block-wrapper-section
        ================================================== -->
    <section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title">
                                @if($subchild_cat) {{ $subchild_cat->name_bd }} @elseif($child_cat) {{ $child_cat->name_bd }} @elseif($subcategory) {{ $subcategory->subcategory_bd}} @else  {{$category->category_bd}} @endif
                            </span>
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


    <section class="block-wrapper">
        <div class="container section-body">
            <div class="row">
                <div class="col-sm-9" id="sticky-conent">
                    @if($subcategory)
                        <ul class="category-news">
                            <li><i class="fa fa-home"></i><a href="{{ route('category', [$category->cat_slug_en]) }}"> {{$category->category_bd}} </a> / <a href="{{ route('category', [$category->cat_slug_en, $subcategory->subcat_slug_en]) }}">{{$subcategory->subcategory_bd}} </a>

                            @if($child_cat)
                             / <a href="{{ route('category', [$category->cat_slug_en, $subcategory->subcat_slug_en, $child_cat->slug_en]) }}">{{$child_cat->name_bd}} </a>
                            @endif

                            @if($subchild_cat)
                             / <a href="{{ route('category', [$category->cat_slug_en, $subcategory->subcat_slug_en, $child_cat->slug_en, $subchild_cat->slug_en]) }}">{{$subchild_cat->name_bd}} </a>
                            @endif
                            </li>
                        </ul>
                    @endif
                    <div class="advertisement">
                        <div class="desktop-advert">
                           {!! $topOfNews !!}
                        </div>
                    </div>

                    <?php $i = 1;?>
                    @if(count($categories) > 0)
                        <div class="grid-box">
                            <div class="row">

                                    @foreach($categories as $news)
                                        @if(Request::get('page') <= 1)
                                            @if($i==1)
                                                <div class="col-md-6 col-sm-6" >
                                                    <div class="news-post standard-post2">
                                                        <div class="post-gallery">
                                                            <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                            @if($news->type == 3)
                                                                <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                            @elseif($news->type == 4)
                                                                <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                            @else @endif
                                                        </div>
                                                        <div class="post-title box_title">
                                                            <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 70)}} </a></h2>
                                                            <span>{!!Str::limit(strip_tags($news->news_dsc), 150)!!}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-3 col-xs-6 col-sm-3">
                                                    <div class="news-post standard-post2">
                                                        <div class="post-gallery">
                                                            <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                            @if($news->type == 3)
                                                                <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                            @elseif($news->type == 4)
                                                                <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                            @else @endif
                                                        </div>
                                                        <div class="post-title">
                                                            <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                                            <ul class="post-tags">

                                                                <li>
                                                                    <i class="fa fa-tags"></i>
                                                                     @if($subchild_cat) {{ $subchild_cat->name_bd }} @elseif($child_cat) {{ $child_cat->name_bd }} @elseif($subcategory) {{ $subcategory->subcategory_bd}} @else  {{$category->category_bd}} @endif
                                                                </li>

                                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($news->publish_date)}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($i==13)
                                             <div class="col-md-12 col-sm-12">
                                                <div class="advertisement">
                                                    <div class="desktop-advert">
                                                        {!! $middleOfNews !!}
                                                    </div>
                                                    
                                                </div>
                                             </div>
                                            @endif
                                        @else
                                            <div class="col-md-3 col-xs-6 col-sm-3">
                                                <div class="news-post standard-post2">
                                                    <div class="post-gallery">
                                                        <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                        @if($news->type == 3)
                                                            <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                        @elseif($news->type == 4)
                                                            <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                        @else @endif
                                                    </div>
                                                    <div class="post-title">
                                                        <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i>
                                                                     @if($subchild_cat) {{ $subchild_cat->name_bd }} @elseif($child_cat) {{ $child_cat->name_bd }} @elseif($subcategory) {{ $subcategory->subcategory_bd}} @else  {{$category->category_bd}} @endif
                                                                </li>
                                                            <li><i class="fa fa-clock-o"></i>{{banglaDate($news->publish_date)}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                     <?php $i++;?>
                                 @endforeach
                            </div>
                        </div>
                        <!-- pagination box -->
                        <div class="pagination-box">
                            {{$categories->links()}}
                        </div>
                        <!-- End Pagination box -->
                    @else
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h1>{{ __('lang.not_found') }}</h1>
                            
                            @include('frontend.layouts.deshjure')
                        </div>
                    </div>
                    @endif
                    @if($i==21)
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                     @endif
                </div>

                <div class="col-sm-3 div_border" id="sticky-conent">
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
