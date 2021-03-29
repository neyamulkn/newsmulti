<?php
    
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 1)
    ->limit(6)
    ->orderBy('news.id', 'DESC')
    ->where('news.lang', '=', 2)
    ->select('news.*','categories.category_en', 'sub_categories.subcategory_en','media_galleries.source_path', 'media_galleries.title')->get();

$popular_news =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 1)
    ->orderBy('view_counts', 'DESC')
    ->where('news.lang', '=', 2)
    ->select('news.*','categories.category_en', 'sub_categories.subcategory_en','media_galleries.source_path')->take(5)->get();


?>

    <div class="widget tab-posts-widget">

        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="#option1" data-toggle="tab">Recent</a>
            </li>
            <li>
                <a href="#option2" data-toggle="tab">Popular</a>
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
                                <li><i class="fa fa-tags"></i>{{$recent->category_en}}</li>
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
            <h1><span>Our facebook</span></h1>
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

            if(Session::get('locale')){
               $get_most_views = $get_most_views->where('news.lang', '=', 2);
            }else{
               $get_most_views = $get_most_views->where('news.lang', '=', 1);
            }

            
            $get_most_views = $get_most_views->orderBy('news.view_counts', 'DESC')->where('news.status', '=', 1)
            ->select('news.*','media_galleries.source_path', 'media_galleries.title')->get();
        ?>
        <div class="widget features-slide-widget">
            <div class="title-section">
                <h1><span>Most Read</span></h1>
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
    @else
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
    @endif

    <!--<div class="advertisement">-->
    <!--    <div class="desktop-advert">-->
            
    <!--    </div>-->
    <!--    <div class="tablet-advert">-->
            
    <!--    </div>-->
    <!--    <div class="mobile-advert">-->
            
    <!--    </div>-->
    <!--</div>-->
