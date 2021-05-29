<?PHP
function banglaDate($date){

    return Carbon\Carbon::parse($date)->format('d F, Y');

    }
?>
@if($find_page)
    @if($find_page->template == 1)
        {!! $find_page->page_dsc !!}
    @elseif($find_page->template == 2)
        <?php $get_news = App\Models\News::with(['categoryList', 'image']);
        if(Session::get('locale')){
           $get_news = $get_news->where('lang', '=', 'en');
        }else{
           $get_news = $get_news->where('lang', '=', 'bd');
        }

        $get_news = $get_news->where('status', '=', 'active')->orderBy('id', 'DESC')->paginate(25) ?>

        <div class="row">
            <div class="grid-box">
                <?php $i = 1;?>
                    @foreach($get_news as $news)
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
                                            <ul class="post-tags">

                                            <li> @if($news->categoryList)
                                                <i class="fa fa-tags"></i>{{$news->categoryList->category_en}}@endif
                                            </li>

                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($news->publish_date)}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-3 col-sm-3">
                                    <div class="news-post standard-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">

                                        </div>
                                        <div class="post-title">
                                            <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                            <ul class="post-tags">

                                            <li> @if($news->categoryList)
                                                <i class="fa fa-tags"></i>{{$news->categoryList->category_en}}@endif
                                            </li>

                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($news->publish_date)}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-md-3 col-sm-3">
                                <div class="news-post standard-post2">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">

                                    </div>
                                    <div class="post-title">
                                        <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                        <ul class="post-tags">
                                            <li> @if($news->categoryList)
                                                <i class="fa fa-tags"></i>{{$news->categoryList->category_en}}@endif</li>
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
            {{$get_news->links()}}
        </div>
    @elseif($find_page->template == 3)
        <?php $reporters = DB::table('users')->leftJoin('reporters', 'users.id', 'reporters.user_id')->where('users.role_id', 'reporter')->orderBy('reporters.id', 'ASC')->get(); ?>

        <div class="row">
            @foreach($reporters as $reporter)

            <div class="col-md-3  col-xs-6" id="author-list">
                <div class="news-post image-post default-size">
                    <img src="{{asset('upload/images/users/thumb_image/'. $reporter->image)}}" alt="{{$reporter->username }}">
                    <div class="hover-box">
                        <div class="inner-hover top-line"  style="display:block !important ">
                            <h2><a href="{{route('reporter_details', $reporter->username)}}">{{$reporter->name}}</a></h2>
                            <ul class="post-tags">
                                <li></li>
                                <li style="font-size: 15px"><i class="fa fa-tags"></i>{{$reporter->designation}}</li>
                            </ul>
                            <p><ul class="social-icons">
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="rss" href="#"><i class="fa fa-rss"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @elseif($find_page->template == 3)

    @else

    @endif
@endif
