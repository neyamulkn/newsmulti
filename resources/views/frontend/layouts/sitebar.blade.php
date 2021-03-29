 <?php
    
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 1)
    ->limit(6)
    ->orderBy('news.id', 'DESC')
    ->where('news.lang', 1)
    ->select('news.*','categories.category_bd', 'sub_categories.subcategory_bd','media_galleries.source_path', 'media_galleries.title')->get();

$popular_news =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 1)
    ->where('news.lang', 1)
    ->orderBy('view_counts', 'DESC')
    ->select('news.*','categories.category_bd', 'sub_categories.subcategory_bd','media_galleries.source_path')->take(5)->get();

?>

    <div class="widget tab-posts-widget">

        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="#option1" data-toggle="tab">সর্বশেষ</a>
            </li>
            <li>
                <a href="#option2" data-toggle="tab">জনপ্রিয়</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="option1">
                <ul class="list-posts">
                    @foreach($recent_news as $recent)
                    <li>
                        <img src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}" alt="">
                        @if($recent->type == 3)
                            <a class="play-link" href="{{route('news_details', $recent->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                        @elseif($recent->type == 4)
                            <a class="play-link" href="{{route('news_details', $recent->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                        @else @endif
                        <div class="post-content">
                            <h2><a href="{{route('news_details', $recent->news_slug)}}">{{Str::limit($recent->news_title, 60)}}</a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-tags"></i>{{$recent->category_bd}}</li>
                                <li><i class="fa fa-clock-o"></i>{{banglaDate($recent->publish_date)}}</li>
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane " id="option2">
                <ul class="list-posts">
                    @foreach($popular_news as $popular)
                        <li>
                            <img src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}" alt="">
                             @if($popular->type == 3)
                            <a class="play-link" href="{{route('news_details', $popular->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                            @elseif($popular->type == 4)
                                <a class="play-link" href="{{route('news_details', $popular->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                            @else @endif
                            <div class="post-content">
                                <h2><a href="{{route('news_details', $popular->news_slug)}}">{{Str::limit($popular->news_title, 60)}}</a></h2>
                                <ul class="post-tags">
                                    <li><i class="fa fa-eye"></i>{{$popular->view_counts}}</li>
                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($popular->publish_date)}}</li>
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="widget social-widget">
        <div class="title-section">
            <h1><span>আমাদের ফেইসবুক </span></h1>
        </div>
        <ul class="social-share">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbdtype&tabs&width=340&height=180&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=112996556002586" height="180" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </ul>
    </div>

    @if(Route::currentRouteName() == 'category')
        <?php         
        $get_most_views =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5);
            if(Request::segment(3)){
                $get_most_views =$get_most_views->where('sub_categories.subcat_slug_en', Request::segment(3));
                
            }else{
               $get_most_views =$get_most_views->where('categories.cat_slug_en',Request::segment(2));
            }
            
            $get_most_views = $get_most_views->orderBy('news.view_counts', 'DESC')->where('news.status', '=', 1)
            ->select('news.*','media_galleries.source_path', 'media_galleries.title')->get();
        ?>
        <div class="widget features-slide-widget">
            <div class="title-section">
                <h1><span>এই বিভাগের সর্বোচ্চ পঠিত</span></h1>
            </div>
            <ul class="list-posts">
                @foreach($get_most_views as $most_views)
                    <li>
                        <img src="{{ asset('upload/images/thumb_img/'. $most_views->source_path)}}" alt="">
                         @if($most_views->type == 3)
                                <a class="play-link" href="{{route('news_details', $most_views->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                @elseif($most_views->type == 4)
                                    <a class="play-link" href="{{route('news_details', $most_views->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                @else @endif
                        <div class="post-content">
                            <h2><a href="{{route('news_details', $most_views->news_slug)}}">{{Str::limit($most_views->news_title, 60)}}</a></h2>
                            <ul class="post-tags">
                                 <li><i class="fa fa-eye"></i>{{$most_views->view_counts}}</li>
                                <li><i class="fa fa-clock-o"></i>{{banglaDate($most_views->publish_date)}}</li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(!Request::is('/'))
        <div class="title-section">
            <h1><span>এক ক্লিকে বিভাগের খবর</span></h1>
        </div>
        <div class="map">
            @include('frontend.map');
        </div>
    
        @include('frontend.layouts.deshjure')
    @endif

 