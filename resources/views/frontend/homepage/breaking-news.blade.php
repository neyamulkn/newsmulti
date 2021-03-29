<!-- breaking news -->
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
    <div class="container" style="padding: 8px 8px">
        <div class="row">
            
            <div class="col-md-8">
                <section class="ticker-news">
                    <div class="ticker-news-box" style=" box-shadow:0 0 6px -3px {{ $section->text_color }};">
                        <span class="breaking-news">{{$section->title}} </span>
                        <?php $get_breaking_news = DB::table('news')->where('breaking_news', 1)->where('lang', 1)->where('status', '=', 1)->select('news_title', 'news_slug', 'created_at')->take($section->item_number)->orderBy('id', 'DESC')->get(); ?>
                        <ul id="js-news">
                            @if(count($get_breaking_news)>0)
                                @foreach($get_breaking_news as $breaking_news)
                                    <li class="news-item"><a style="color:{{ $section->text_color }}" href="{{route('news_details', $breaking_news->news_slug)}}">{{$breaking_news->news_title}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-md-4 hidden-xs">
                <ul class="feature-icon" style="background:#F4FAF6;box-shadow: 0 0 6px -3px {{ $section->text_color }}">
                    <li><a  href="{{url('live-tv')}}"><i style="color: red" class="fa fa-microphone"></i> লাইভ টিভি </a></li>
                    <li><a  href="{{url('video')}}"><i style="color: blue" class="fa fa-video-camera"></i> ভিডিও </a></li>
                    <li><a class="linkedin" href="{{url('gallery')}}"><i style="color: #ddd;" class="fa fa-camera"></i> ছবি </a></li>
                    <li><a href="" class="youtube"><i style="color: #BAD333;" class="fa fa-android"></i> Android</a></li>
                    <li><a href="https://www.instagram.com/bdtype/" class="instagram"><i style="color: #00A4DD" class="fa fa-apple"></i> iOS</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End breaking news -->
