
@extends('frontend.en.layouts.master')
@section('title')
   {{__('lang.not_found')}} | BDtype
@endsection
@section('Metatag') @endsection
@section('css')
<style type="text/css">
    .error-banner h1{font-size: 45px;}
</style>
@endsection

@section('content')

<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'reporter_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 1){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 2){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 3){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position ==4){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position ==5){
        $sitebarBottom = $ads->add_code;
    }else{
        echo '';
    }
}
function banglaDate($date){

   return Carbon\Carbon::parse($date)->diffForHumans();
    
    }

?>
        <section class="ticker-news category">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title">Error 404</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {!! $top_head_right !!}
{{--                        <img src="{{asset('frontend')}}/upload/addsense/add.jpg" height="45">--}}
                    </div>
                </div>
            </div>
        </section>
<!-- block-wrapper-section
            ================================================== -->
        <section class="block-wrapper">
            <div class="container section-body">
                <div class="row">
                    <div class="col-sm-8">

                        <!-- block content -->
                        <div class="block-content">

                            <!-- error box -->
                            <div class="error-box">
                                <div class="error-banner">
                                    
                                    <h1> <span>{{__('lang.not_found')}}</span></h1>
                                    <p>Oops! It looks like nothing was found at this location. Maybe try another link or a search?</p>
                                </div>
                                <div class="search-box">
                                    <form action="{{route('search_result')}}" method="get"  role="search" class="search-form">
                                        <input type="text" name="q" value="{{Request::get('q')}}"  id="search2" placeholder="Search here">
                                         <button type="submit" id="search-submit2"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <!-- End error box -->
                            <?php $get_news = App\Models\News::with(['categoryList', 'image'])->orderBy('id', 'DESC')->take(12)->get() ?>
                            <!-- grid box -->
                            <div class="grid-box">
                                <div class="title-section">
                                    <h1><span>Popular Posts</span></h1>
                                </div>
                                <div class="row">
                                    @foreach($get_news as $news)
                                    <div class="col-md-6">
                                        <ul class="list-posts">
                                            <li>
                                               @if($news->image)
                                                <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                @endif
                                                @if($news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="post-content">
                                                    
                                                    <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 70)}} </a></h2>
                                                    @if($news->categoryList)
                                                    <ul class="post-tags">
                                                        <li><a href="{{route('category', $news->categoryList->cat_slug_en )}}">{{$news->categoryList->category_bd}}</a></li>
                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($news->publish_date)}}</li>
                                                    </ul>
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                            <!-- End grid box -->

                        </div>
                        <!-- End block content -->

                    </div>

                    <div class="col-sm-4 div_border">
                        <div class="sidebar large-sidebar">
                          @include('frontend.en.layouts.sitebar')

                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End block-wrapper-section -->

@endsection
