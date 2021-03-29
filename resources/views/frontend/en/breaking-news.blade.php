<section>
    <div class="container" style="padding: 8px 8px">
        <div class="row">
            
            <div class="col-md-8">
                <section class="ticker-news">
                    <div class="ticker-news-box" style=" box-shadow:0 0 6px -3px #000">
                        <span class="breaking-news">Breaking News </span>
                        <?php $get_breaking_news = DB::table('news')->where('breaking_news', 1)->where('lang', 2)->where('status', '=', 1)->select('news_title', 'news_slug', 'created_at')->take(4)->orderBy('id', 'DESC')->get(); ?>
                        <ul id="js-news">
                            @if(count($get_breaking_news)>0)
                                @foreach($get_breaking_news as $breaking_news)
                                    <li class="news-item"><a style="color:#000" href="{{route('news_details', $breaking_news->news_slug)}}">{{$breaking_news->news_title}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-md-4  hidden-xs">
                <ul class="feature-icon" style="background:#F4FAF6;box-shadow: 0 0 6px -3px #000">
                    <li><a  href="{{url('live-tv')}}"><i style="color: red" class="fa fa-microphone"></i> Live TV</a></li>
                    <li><a  href="{{url('video')}}"><i style="color: blue" class="fa fa-video-camera"></i> Video</a></li>
                    <li><a class="linkedin" href="{{url('gallery')}}"><i style="color: #ddd;" class="fa fa-camera"></i> Picture</a></li>
                    <li><a href="" class="youtube"><i style="color: #BAD333;" class="fa fa-android"></i> Android</a></li>
                    <li><a href="https://www.instagram.com/bdtype/" class="instagram"><i style="color: #00A4DD" class="fa fa-apple"></i> iOS</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</section>