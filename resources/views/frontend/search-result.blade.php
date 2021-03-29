@extends('frontend.layouts.master')
@section('title')
    {{Request::get('q')}} - বিডি টাইপ
@endsection
@section('Metatag') @endsection

@section('content')
<?PHP

$get_ads = App\Models\Addvertisement::where('page', 'search_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $siteBarMiddle = $sitebarBottom = null ;
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
                        <span class="breaking-news" id="head-title">Search Result ({{$search_results->total()}})</span>
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
                <div class="col-sm-9 divrigth_border">
                     <div class="grid-box">
                        <div class="row">
                                <div class="col-md-12 ">
                                    <div class="advertisement">
                                        <div class="desktop-advert">
                                           {!! $topOfNews !!}
                                        </div>
                                    </div>
                                    <form action="{{route('search_result')}}" method="get" class="jumbotron" class="subscribe-form">
                                    <input type="text" name="q" value="{{Request::get('q')}}" style="width: 85%; padding: 10px;" id="subscribe" placeholder="Email">
                                    <button id="submit-subscribe" style="padding:10px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <h5>Search Result For > {{Request::get('q')}}</h5>
                                </form>

                                </div>

                                    @foreach($search_results as $search_result)

                                        <div class="col-md-3 col-sm-3">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $search_result->source_path)}}" alt="">

                                                </div>
                                                <div class="post-title">
                                                    <h2><a href="{{route('news_details', $search_result->news_slug)}}">{{Str::limit($search_result->news_title, 40)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li> @if($search_result->subcategoryList)
                                                            <i class="fa fa-tags"></i>{{$search_result->subcategoryList->subcategory_bd}}@endif</li>
                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($search_result->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                @endforeach

                        </div>
                    </div>
                    <!-- pagination box -->
                    <div class="pagination-box">
                        {{$search_results->links()}}

                    </div>
                    <!-- End Pagination box -->

                    <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-sm-3">

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
