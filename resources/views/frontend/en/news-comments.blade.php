@extends('frontend.en.layouts.master')
@section('title')
    ({{$comments->count()}}) Comments - {{$get_news->news_title}} | BdType
@endsection
@section('MetaTag')
    <meta name="keywords" content="{{ $get_news->keywords }}" />
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{$get_news->news_title}}">
    <meta itemprop="description" content="{{Str::limit(strip_tags($get_news->news_dsc), 200)}}">
    <meta itemprop="image" content="{{asset('upload/images/'.$get_news->image->source_path)}}">

        <!-- Twitter -->
    <meta name="twitter:card" content="{{Str::limit(strip_tags($get_news->news_dsc), 150)}}">
    <meta name="twitter:title" content="{{$get_news->news_title}}">
    <meta name="twitter:description" content="{{Str::limit($get_news->news_dsc, 200)}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Bdtype">
    <meta name="twitter:image:src" content="{{asset('upload/images/'.$get_news->image->source_path)}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="{{$get_news->news_title}}">
    <meta name="og:description" content="{{Str::limit(strip_tags($get_news->news_dsc), 100)}}">
    <meta name="og:image" content="{{asset('upload/images/'.$get_news->image->source_path)}}">
     <meta name="og:url" content="{{ url()->full() }}">
    <meta name="og:site_name" content="Bdtype">
    <meta name="og:locale" content="en">
    <meta name="og:video" content="@if($get_news->type == 3 && count($get_news->attachFiles)>0) {{asset('upload/file/'.$get_news->attachFiles[0]->source_path)}}@endif">
    <meta name="fb:admins" content="1323213265465">
    <meta name="fb:app_id" content="13212465454">
    <meta name="og:type" content="product">

    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="amphtml" href="{{ url()->full() }}" />
    <link rel="alternate" href="{{ url()->full() }}">

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
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
    if($ads->position == 1){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 2){
        $topOfNews = $ads->add_code;
    }elseif($ads->position == 3){
        $middleOfNews = $ads->add_code;
    }elseif($ads->position == 4){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 5){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position ==6){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position ==7){
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
                <div class="col-sm-3 col-xs-12">
                    <div class="category-title">
                       <span class="breaking-news" id="head-title">
                            মন্তব্যসমূহ ({{ str_replace([1,2,3,4,5,6,7,8,9,0], ['১','২','৩','৪','৫','৬','৭','৮','৯','০'], $comments->count() )}})
                       	</span>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<div class="single-post-box" style="text-align: right;">
            			<div class="share-post-box">
							<ul class="share-box">
								<li><i class="fa fa-share-alt"></i></li>
								<li><a class="facebook"  href="http://www.facebook.com/sharer.php?u={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="https://twitter.com/share?url={{ route('news_details', $get_news->news_slug) }}&amp;text={!! $get_news->news_title !!}&amp;hashtags=Bdtype" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="google" href="http://reddit.com/submit?url={{ route('news_details', $get_news->news_slug) }}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="whatsapp" href="http://reddit.com/submit?url={{ route('news_details', $get_news->news_slug) }}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-reddit"></i></a></li>
                                <li><a class="linkedin"  href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#" class="rss"><i class="fa fa-rss"></i></a></li>
									<!-- <li><a class="whatsapp"  href="https://web.whatsapp.com/send?text={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li> -->
							</ul>
						</div>
					</div>
                </div>
                <div class="col-sm-3 col-xs-12">
                   {!!  $top_head_right !!}
                </div>
            </div>
            </div>
        </div>
    </section>
	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container section-body" >
			<div class="row">
				<div class="col-sm-9 divrigth_border">
                    <div class="advertisement">
                        <div class="desktop-advert">
                            {!! $topOfNews !!}
                        </div>
                        <div class="tablet-advert">
                            {!! $topOfNews !!}
                        </div>
                        <div class="mobile-advert">
                            {!! $topOfNews !!}
                        </div>
                    </div>
					<!-- block content -->
					<div class="block-content">
						<!-- single-post box -->
						<div class="single-post-box">

							<div class="title-post">

								<h1><a href="{{route('news_details', $get_news->news_slug)}}" >{{$get_news->news_title}}</a></h1>
								<ul class="post-tags">
									<li><i class="fa fa-user"></i>by <a href="{{route('reporter_details', $get_news->reporter->username)}}">{{$get_news->reporter->name}}</a></li>
									<li><i class="fa fa-clock-o"></i>{{banglaDate($get_news->publish_date)}} {{Carbon\Carbon::parse($get_news->publish_date)->diffForHumans()}}</li>
									<li><a href="#"><i class="fa fa-comments-o"></i><span>{{$comments->count()}}</span></a></li>
									<li><i class="fa fa-eye"></i>{{$get_news->view_counts}}</li>
									<li></li>
								</ul>
							</div>

							<!-- comment area box -->
							<div class="comment-area-box">
								
								<ul class="comment-tree" id="show_comment">
                                    @if(count($comments)>0)
                                        <?php $i = 1; ?>
                                        @foreach($comments as $comment)
    									<li  style="background: #f7f7f7">
    										<div class="comment-box">
    											<img alt="" src="{{ asset('upload/images/users/thumb_image/'.$comment->user->image) }}">
    											<div class="comment-content">
    												<h4>{{$comment->user->name}}<a @guest data-toggle="modal" data-target="#loginModal" @else onclick="reply_field('{{$comment->id}}')"  @endguest style="cursor: pointer;" ><i class="fa fa-comment-o"></i>Reply</a></h4>
    												<span><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
    												<p>{{$comment->comments}}</p>
    											</div>
    										</div>
                                           <!--  Reply comments -->
                                            <ul class="depth" id="show_replyComment{{$comment->id}}">
                                               
                                                <?php  $replyComments = App\Models\Comment::where('comment_id', $comment->id)->get(); ?>
                                                @if($replyComments)
        											@foreach($replyComments as $replyComment)
                                                        <li  style="background: #fff">
            												<div class="comment-box" style="margin: 0px;">
            													<img alt="" src="{{asset('upload/images/users/thumb_image/'.$replyComment->user->image)}}">
            													<div class="comment-content">
            														<h4>{{$replyComment->user->name}} </h4>
            														<span><i class="fa fa-clock-o"></i>{{ Carbon\Carbon::parse($replyComment->created_at)->diffForHumans()}}</span>
            														<p>{{$replyComment->comments}}</p>
            													</div>
            												</div>
            											</li>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                            </ul>
    									</li>
                                        <li><!-- COMMENT REPLY FORM -->
                                            <form style="display: none;" method="post" action="{{route('comment_reply', $comment->id)}}" id="reply_form{{$comment->id}}" class="comment-reply-form">
                                                @csrf 
                                                <input type="hidden" name="news_id" value="{{$comment->news_id}}">
                                                <textarea name="reply_comment" class="reply-box" rows="1" required  placeholder="মন্তব্য লেখুন.."></textarea><button onclick="reply('{{$comment->id}}')" class="btn btn-primary btn-sm" type="submit" >Reply</button>
                                            </form>
                                            <!-- /COMMENT REPLY FORM -->
                                        </li>
                                        
                                        @endforeach
                                       
                                    @endif
                                </ul>
							</div>
                           
							<!-- End comment area box -->
							
							<!-- contact form box -->
							<div class="contact-form-box">
								
								@if(!Auth::check())
                                <div class="title-section">
                                   
                                    <h1><span>মন্তব্য করতে নিবন্ধন করুন </span>
                                    <span style="background: #fff;" class="email-not-published">
                                        মন্তব্য করতে <a type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-xs">  লগইন</a>করুন</span></h1>
                                </div>
                                <br/>
								<form action="{{ route('registrationAndComment') }}" method="post" id="comment-form">
                                    @csrf
									<div class="row">
										<div class="col-md-4">
											<label for="name">নাম*</label>
											<input required="" id="name" value="{{ old('name') }}"  name="name" type="text">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="col-md-4">
											<label for="mobile_or_email">ইমেইল বা মোবাইল*</label>
											<input required id="mobile_or_email"  value="{{ old('mobile_or_email') }}" name="mobile_or_email" type="text">

                                            @error('mobile_or_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
                                        <div class="col-md-2">
                                            <label for="password">পাসওয়ার্ড*</label>
                                            <input required id="password" name="password" type="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 

                                        <div class="col-md-2">
                                            <label required for="password">পুনরায় পাসওয়ার্ড*</label>
                                            <input id="password" name="password_confirmation" type="password">
                                           
                                        </div>
									</div>
									<label for="comment">মন্তব্য লেখুন*</label>
                                     <input type="hidden" name="news_id" value="{{ $get_news->id }}">
									<textarea id="comment" rows="2" name="comment">{{ old('comment') }}</textarea>
									<button required type="submit" id="submit-contact">
										<i class="fa fa-comment"></i> মন্তব্য প্রকাশ করুন
									</button>
								</form>
								@else
								<form action="{{route('comment_insert')}}"  method="get" id="comment">
									<label for="comment">মন্তব্য লেখুন*</label>
                                    <input type="hidden" name="news_id" value="{{ $get_news->id }}">
									<textarea rows="2" required id="comment" required="" name="comment">{{ old('comment') }}</textarea>
									<button type="submit" id="submit-contact">
										<i class="fa fa-comment"></i> মন্তব্য প্রকাশ করুন
									</button>
								</form>
								@endif
							</div><br/>
							<!-- End contact form box -->

							@if(count($more_news)>0)
							<!-- more news box -->
							<div class="carousel-box owl-wrapper">
								<div class="title-section">
									<h1><span>এই বিভাগের আরও খবর</span></h1>
								</div>
								<div class="row">
                                    @foreach($more_news as $news)
										<div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                </div>
                                                <div class="post-title">
                                                    <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i>{{ ($news->subcategory) ? $news->subcategoryList->subcategory_bd : $news->categoryList->category_bd}}</li>

                                                        <li><i class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($news->publish_date)->diffForHumans()}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
								</div>
							</div>
							<!-- End carousel box -->
							@endif
						</div>
						<!-- End single-post box -->
					</div>
					<!-- End block content -->
                    <div class="advertisement">
                        <div class="desktop-advert">
                            {!! $bottomOfNews !!}
                        </div>
                        <div class="tablet-advert">
                            {!! $bottomOfNews !!}
                        </div>
                        <div class="mobile-advert">
                            {!! $bottomOfNews !!}
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
                                <div class="tablet-advert">
                                    {!! $sitebarTop !!}
                                </div>
                                <div class="mobile-advert">
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
                                <div class="tablet-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                                <div class="mobile-advert">
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
<!-- Modal -->
<div id="loginModal" tabindex="-1" style="z-index: 99999;" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding: 6px 5px; background: #fd0707; color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
            <form action="{{ route('userlogin') }}" method="post">
                @csrf
                <div class="form-group">
                   <label for="mobile_or_email">Mobile number or email*</label>
                    <input id="mobile_or_email"  required class="form-control" name="mobile_or_email" type="text">
                    @error('email_or_phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input id="password" required class="form-control" name="password" type="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-default">Sign In</button>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

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