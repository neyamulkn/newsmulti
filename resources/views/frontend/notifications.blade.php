@extends('frontend.layouts.master')
@section('title')
     Notications | বিডি টাইপ
@endsection
@section('MetaTag')


@endsection

@section('css')

<style type="text/css">
	.single-post-box .post-gallery img {
	  /*  width: initial !important; */
	}
	.single-post-box > .post-content{
		line-height: 28px;
	}
    .reply-box{
        width:100%;resize: vertical;
    }

</style>

@endsection
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'details_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
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
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>

@section('content')
    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="category-title">
                       <span class="breaking-news" id="head-title">
                            Your Notifications 
                       	</span>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                   <div class="rightAds">
                        {!! $top_head_right !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
	<!-- block-wrapper-section ========= -->
        <section class="block-wrapper">
            <div class="container section-body">
                <div class="row">
                    <div class="col-sm-8 ">

                        <!-- block content -->
                        <div class="block-content">

                            <!-- forum box -->
                            <div class="forum-box">
                               
                                <div class="forum-table">
                                    @foreach($notifications as $notification)
                                        @if($notification->type == env('NEWS'))
                                        @if($notification->news)
                                        <div class="table-row">
                                            <div class="forum-post">
                                                    <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->image)}}">
                                                   
                                                    <div class="post-autor-date">
                                                        <a onclick="readNotify('{{$notification->id}}')" @if($notification->news->status == 1) href="{{route('news.list')}}" @elseif($notification->news->status == 2) href="{{route('news.draft')}}" @else  href="{{route('news.pending')}}" @endif>

                                                        <strong>{{$notification->notify}} </strong>{{Str::limit($notification->news->news_title, 200)}} </a>
                                                        <p>comment by: <a href="{{route('user_profile', $notification->user->username)}}">{{$notification->user->username}}</a></p>
                                                        <p><i class="fa fa-clock-o"> </i> {{$notification->created_at->diffForHumans()}} <i class="fa fa-calendar"> </i>    {{$notification->created_at->format('d M, Y')}} </p>
                                                    </div>
                                                
                                            </div>
                                            
                                        </div>
                                        @endif
                                        @endif

                                        @if($notification->type == env('COMMENT'))
                                        @if($notification->comment && $notification->comment->news)
                                        <div class="table-row">
                                            <div class="forum-post">
                                                    <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->image)}}">
                                                   
                                                    <div class="post-autor-date">
                                                         <a onclick="readNotify('{{$notification->id}}')" href="{{route('comments',$notification->comment->news->news_slug)}}#singleComment{{$notification->item_id}}"><strong>{{$notification->notify}} </strong>{{Str::limit($notification->comment->comments, 200)}} </a>
                                                        <p>comment by: <a href="{{route('user_profile', $notification->user->username)}}">{{$notification->user->username}}</a></p>
                                                        <p><i class="fa fa-clock-o"> </i> {{$notification->created_at->diffForHumans()}} <i class="fa fa-calendar"> </i>    {{$notification->created_at->format('d M, Y')}} </p>
                                                    </div>
                                            </div>
                                            
                                        </div>
                                        @endif
                                        @endif

                                        @if($notification->type == env('REPORTER_NOTIFY'))
                                        @if($notification->user)
                                        <div class="table-row">
                                            <div class="forum-post">
                                                    <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->image)}}">
                                                   
                                                    <div class="post-autor-date">
                                                        @if(Auth::user()->role_id != env('ADMIN'))
                                                        <a onclick="readNotify('{{$notification->id}}')" href="{{route('user_profile', $notification->user->username)}}">
                                                        @endif
                                                        @if(Auth::user()->role_id == env('ADMIN'))
                                                        <a onclick="readNotify('{{$notification->id}}')" href="{{route('reporterRequest.list')}}">
                                                        @endif
                                                        <strong>{{$notification->notify}} </strong> </a>
                                                        <p>comment by: <a href="{{route('user_profile', $notification->user->username)}}">{{$notification->user->username}}</a></p>
                                                        <p><i class="fa fa-clock-o"> </i> {{$notification->created_at->diffForHumans()}} <i class="fa fa-calendar"> </i>    {{$notification->created_at->format('d M, Y')}} </p>
                                                    </div>
                                                
                                            </div>
                                            
                                        </div>
                                        @endif
                                        @endif
                                    @endforeach
                                     {{$notifications->links()}}
                                </div>
                              

                            </div>
                            <!-- End forum box -->

                        </div>
                        <!-- End block content -->

                    </div>

                    <div class="col-sm-4">
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

@section('js')

    {!! Toastr::message() !!}
    <script>

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        @if(Session::get('submitType'))
         $("#loginModal").modal('show');
        @endif
    </script>
        <script type="text/javascript">

            $('#linkIncrease').click(function () {
                modifyFontSize('increase');
            });

            $('#linkDecrease').click(function () {
                modifyFontSize('decrease');
            });

            $('#linkReset').click(function () {
                modifyFontSize('reset');
            })

            function modifyFontSize(flag) {
                var divElement = $('#divContent');
                var currentFontSize = parseInt(divElement.css('font-size'));
                if (flag == 'increase')
                    currentFontSize += 2;
                else if (flag == 'decrease')
	                currentFontSize -= 2;
                else
                    currentFontSize = 16;
                divElement.css('font-size', currentFontSize);
                $('p').css('font-size', currentFontSize);
            }


    /// comment
     $(function(){
            $("#comment").submit(function(event){
                event.preventDefault();
              
                $.ajax({
                        url:'{{route("comment_insert")}}',
                        type:'GET',
                        data:$(this).serialize(),
                        success:function(result){
                            document.getElementById("comment").reset();
                            $("#show_comment").append(result);

                        }

                });
            });
        });  

        function reply_field(id){
            document.getElementById('reply_form'+id).style.display = 'block';
        }      

            /// replay comment
     function reply(id){
            $("#reply_form"+id).submit(function(event){
                event.preventDefault();
                var link = '{{route("comment_reply", ":id")}}';
                var link = link.replace(':id', id);
                $.ajax({
                    url:link,
                    type:'post',
                    data:$(this).serialize(),
                    success:function(result){
                        document.getElementById("reply_form"+id).reset();
                        $("#show_replyComment"+id).append(result);

                    }
                });
            });
        }

    </script>

@endsection