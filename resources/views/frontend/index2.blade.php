@extends('frontend.layouts.master')
@section('title', Config::get('siteSetting.title'))

@section('MetaTag')
    <meta name="title" content="{{Config::get('siteSetting.title')}}">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{Config::get('siteSetting.title')}}">
    <meta property="og:description" content="{{Config::get('siteSetting.description')}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:type" content="article">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{Config::get('siteSetting.title')}}">
    <meta itemprop="description" content="{{Config::get('siteSetting.description')}}">
    <meta itemprop="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:title" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.description')}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection

@section('content')
    <?PHP

    function banglaDate($date){
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
        $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
        return $convertedDATE;
    }
    ?>

    <div id="loadSection">
    @include('frontend.homepage.homesection')
    </div>
   <div class="ajax-load text-center" id="data-loader"><img src="{{asset('backend/assets/images/process.gif')}}"></div>
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function(){
        var page = 2;
        loadMoreProducts(page);
           
        function loadMoreProducts(pageNo){
           
            $.ajax(
                {
                    url: '?page=' + pageNo,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#loadSection").append(data.html);
                //check section last page
                if(page <= '{{$sections->lastPage()}}'){
                    page++;
                    loadMoreProducts(page);
                }
               
                //load slider
                $('.bxslider').bxSlider({
                    mode: 'fade',
                    auto: true
                });

                /*-------------------------------------------------*/
                /* =  OWL carousell - featured post, video post, gallery posts
                /*-------------------------------------------------*/
                try {
                    var owlWrap = $('.owl-wrapper');

                    if (owlWrap.length > 0) {

                        if (jQuery().owlCarousel) {
                            owlWrap.each(function(){

                                var carousel= $(this).find('.owl-carousel'),
                                    dataNum = $(this).find('.owl-carousel').attr('data-num'),
                                    dataNum2,
                                    dataNum3;

                                if ( dataNum == 1 ) {
                                    dataNum2 = 1;
                                    dataNum3 = 1;
                                } else if ( dataNum == 2 ) {
                                    dataNum2 = 2;
                                    dataNum3 = dataNum - 1;
                                } else {
                                    dataNum2 = dataNum - 1;
                                    dataNum3 = dataNum - 2;
                                }

                                carousel.owlCarousel({
                                    autoPlay: 10000,
                                    navigation : true,
                                    items : dataNum,
                                    itemsDesktop : [1199,dataNum2],
                                    itemsDesktopSmall : [979,dataNum3]
                                });

                            });
                        }
                    }

                } catch(err) {

                }

                try{        
                    $('#js-news').ticker({
                        speed: 0.20,            // The speed of the reveal
                        controls: true,         // Whether or not to show the jQuery News Ticker controls
                        titleText: '',  // To remove the title set this to an empty String
                        displayType: 'reveal',  // Animation type - current options are 'reveal' or 'fade'
                        direction: 'ltr',       // Ticker direction - current options are 'ltr' or 'rtl'
                        pauseOnItems: 2000,     // The pause on a news item before being replaced
                        fadeInSpeed: 600,       // Speed of fade in animation
                        fadeOutSpeed: 300       // Speed of fade out animation
                    });
                } catch(err) {
                }
       
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
    });
</script>
@endsection

