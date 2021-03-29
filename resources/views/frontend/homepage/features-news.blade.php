@php
    $feature_section_news = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.breaking_news', 1)
            ->limit($section->item_number)
            ->orderBy('news.id', 'DESC')
            ->where('news.status', '=', 1)->where('news.lang', '=', 1)->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();
@endphp

<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        <div class="row">
            <div class="col-md-9  section-body divrigth_border" id="sticky-conent">
                @if(count($feature_section_news)>0)
                <div class="row">
                    <div class="grid-box">
                        <?php $i = 1;?>
                        @foreach($feature_section_news as $section_news)
                            @if($i==1)
                                <div class="col-md-6 col-sm-6">
                                    <div class="news-post standard-post2 ">
                                        <a href="{{route('news_details', $section_news->news_slug)}}">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img_box/'. $section_news->source_path)}}" alt="">
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-title box_title">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 90)}} </a></h2>
                                                <span style="font-size: 12px">{!!Str::limit(strip_tags($section_news->news_dsc), 150)!!}</span>
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
                                                    <li><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>

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
                @endif
            </div>
            <div class="col-md-3 section-body" id="sticky-conent">
                <div class="sidebar large-sidebar">
                    @include('frontend.layouts.sitebar')
                </div>
                
            </div>
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>

