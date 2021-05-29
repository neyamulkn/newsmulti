@php
    $get_picture_voice = App\Models\News::orderBy('news.id', 'DESC')->where('news.status', 'active')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->where('news.type', '2')
        ->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->limit(9)->get();

    $get_visual_gallery =  DB::table('news')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->limit(6)
        ->orderBy('news.id', 'DESC')->where('news.status', '=', 'active')
        ->where('news.type', '3')->where('news.lang', '=', 'bd')
        ->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->get();
@endphp
@if(count($get_picture_voice)>0 || count($get_visual_gallery)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
            <div class="row gallery" style="color: {{$section->text_color}}">
                @if(count($get_picture_voice)>0)
                <div class="col-md-8 divrigth_border">
                    <div class="title-section">
                        <h1><span style="color: {{$section->text_color}};border-bottom: 1px solid #f44336;">{{$section->title}}</span></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-9 ">
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
                                <div class="item news-post standard-post" style="margin-bottom: 25px">
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
                @endif
                @if(count($get_visual_gallery)>0)
                <div class="col-md-4">
                    <div class="title-section">
                        <h1><span style="color: {{$section->text_color}};border-bottom: 1px solid #f44336;">{{$section->sub_title}}</span></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          
                            @foreach($get_visual_gallery as $index => $visual_gallery)
                                @if($index == 0)
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
                                <div class="col-md-12 col-xs-6">
                                    <ul class="list-posts" style="background-color: transparent;">
                                        <li>
                                            <img src="{{ asset('upload/images/thumb_img/'. $visual_gallery->source_path)}}" alt="">
                                            <a class="play-link" href="{{route('news_details', $visual_gallery->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                            <div class="post-content">
                                                <h2><a  style="color: #fff" href="{{route('news_details', $visual_gallery->news_slug)}}">{{Str::limit($visual_gallery->news_title, 50)}}</a></h2>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                             
                            @endforeach

                            <div class="col-md-12">
                                <a style="float: right;background:#B90403; margin-bottom: -3px;  padding: 12px 5px 7px 20px; border-top-left-radius: 60px; color: {{$section->text_color}}" href="{{url('video')}}">সকল ভিডিও দেখুন <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
