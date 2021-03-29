@extends('frontend.en.layouts.master')
@section('title')
    {{$get_news->news_title}} | {{ ($get_news->subcategory) ? $get_news->subcategoryList->subcategory_en. " | " : ''}} {{$get_news->categoryList->category_en}} | BdType
@endsection
@section('MetaTag')
    <meta name="keywords" content="{{ $get_news->keywords }}" />
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{$get_news->news_title}}">
    <meta itemprop="description" content="{{Str::limit(strip_tags($get_news->news_dsc), 200)}}">
    <meta itemprop="image" content="@if($get_news->image) {{asset('upload/images/'.$get_news->image->source_path)}} @endif">

        <!-- Twitter -->
    <meta name="twitter:card" content="{{Str::limit(strip_tags($get_news->news_dsc), 150)}}">
    <meta name="twitter:title" content="{{$get_news->news_title}}">
    <meta name="twitter:description" content="{{Str::limit($get_news->news_dsc, 200)}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Bdtype">
    <meta name="twitter:image:src" content="@if($get_news->image) {{asset('upload/images/'.$get_news->image->source_path)}} @endif">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="{{$get_news->news_title}}">
    <meta name="og:description" content="{{Str::limit(strip_tags($get_news->news_dsc), 100)}}">
    <meta name="og:image" content="@if($get_news->image) {{asset('upload/images/'.$get_news->image->source_path)}} @endif">
     <meta name="og:url" content="{{ url()->full() }}">
    <meta name="og:site_name" content="Bdtype">
    <meta name="og:locale" content="bn_BD">
    <meta name="og:video" content="@if($get_news->type == 3 && count($get_news->attachFiles)>0) {{asset('upload/file/'.$get_news->attachFiles[0]->source_path)}}@endif">
    <meta name="og:type" content="article">

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
    .controlBar{
        font-size: 3rem;
        color: #de0c64;
        clear: both;
        text-align: right;
        border: 1px solid #ece9e9;
        padding: 0px 5px;
    }

    .news_dsc img{
        width: 100% !important;
        height: 1000% !important;
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

    return Carbon\Carbon::parse($date)->format('d F, Y');
   
    }
?>

@section('content')
    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                <div class="col-sm-3">
                    <div class="category-title">
                       <span class="breaking-news" id="head-title">
                       	@if($get_news->subcategory)
                       		<a href="{{$get_news->subcategoryList->subcat_slug_en}}">
                       		{{$get_news->subcategoryList->subcategory_en}}</a>
                       	@else
                       		<a href="{{$get_news->categoryList->cat_slug_en}}">
                       		{{$get_news->categoryList->category_en }}</a>
                       	@endif
                       	</span>
                    </div>
                </div>
                <div class="col-sm-6 ">
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
                <div class="col-sm-3">
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
				<div class="col-sm-9 divrigth_border" id="sticky-conent">
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

								<h1>{{$get_news->news_title}}</h1>
								<ul class="post-tags">
									<li><i class="fa fa-user"></i>by <a href="{{route('reporter_details', $get_news->reporter->username)}}">{{$get_news->reporter->name}}</a></li>
									<li><i class="fa fa-clock-o"></i>{{banglaDate($get_news->publish_date)}} {{Carbon\Carbon::parse($get_news->publish_date)->diffForHumans()}}</li>

									<li><a href="#"><i class="fa fa-comments-o"></i><span>{{$comments->total()}}</span></a></li>
									<li><i class="fa fa-eye"></i>{{$get_news->view_counts}}</li>
									<li></li>
								</ul>
							</div>

							<div class="post-gallery">
                                @if($get_news->type == 2)
                                    <ul class="bxslider">
                                        @foreach($get_news->attachFiles as $attachFile)
                                        <li><img src="{{asset('upload/file/'.$attachFile->source_path)}}" alt=""></li>
                                        @endforeach
                                    </ul>
                                @elseif($get_news->type == 3)
                                    @foreach($get_news->attachFiles as $attachFile)
                                    <video width="100%"  controls>
                                        <source src="{{asset('upload/file/'.$attachFile->source_path)}}" type="video/mp4">
                                    </video>
                                    @endforeach
                                @else
                                    <img title="{{$get_news->title}}" src="@if($get_news->image) {{asset('upload/images/'.$get_news->image->source_path)}} @endif">
                                    <span class="image-caption">@if($get_news->image) {{$get_news->image->title}} @endif</span>
                                @endif
							</div>
							<div class="controlBar">
                                <span title="Read Later" @guest data-toggle="modal" data-target="#loginModal" @else onclick="readLater('{{$get_news->id}}')" @endguest style="cursor: pointer;"><i class="fa fa-book" aria-hidden="true"></i></span>
                                <span title="Zoom In" style="cursor: zoom-in;" id="linkIncrease"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                                <span title="Zoom Out" id="linkDecrease" style="cursor: zoom-out;"><i class="fa fa-minus-circle"  aria-hidden="true"></i></span>
                                <span title="Reset font size" id="linkReset" ><i class="fa fa-undo" aria-hidden="true"></i></span>
                            </div>
							<div class="post-content" id="divContent">
                                {!! $get_news->news_dsc !!}
							</div>
							<!-- <div class="post-tags-box">
								<ul class="tags-box">
									<li><i class="fa fa-tags"></i><span>Tags:</span></li>
                                    @foreach(explode(',', $get_news->keywords) as $keyword)
									    <li><a href="#">{{$keyword}}</a></li>
                                    @endforeach
								</ul>
							</div> -->

							
							<!-- comment area box -->
							<div class="comment-area-box">
								<div class="title-section">
									<h1><span style="background: #fff;color: #000;">Comments ({{ $comments->total() }})</span></h1>
								</div>
                               
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
                                               
                                                <?php  $replyComments = App\Models\Comment::where('comment_id', $comment->id)->take('3')->get(); ?>
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
                                                <textarea name="reply_comment" class="reply-box" rows="1" required  placeholder="Write Your Comments.."></textarea><button onclick="reply('{{$comment->id}}')" class="btn btn-primary btn-sm" type="submit" >Reply</button>
                                            </form>
                                            <!-- /COMMENT REPLY FORM -->
                                        </li>
                                        
                                        @endforeach
                                       
                                    @endif
                                </ul>
                                <ul> @if($comments->total() >= 5 )
                                    <li style="text-align: center;"><a href="{{route('comments', $get_news->news_slug)}}">See All Comments</a><li>
                                @endif</ul>
                               
							</div>
                           
							<!-- End comment area box -->
							
							<!-- contact form box -->
							<div class="contact-form-box">
								
								@if(!Auth::check())
                                <div class="title-section">
                                   
                                    <h1><span>Register to comment </span>
                                    <span style="background: #fff;" class="email-not-published">
                                        To comment <a type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-xs">  Login</a></span></h1>
                                </div>
                                <br/>
								<form action="{{ route('registrationAndComment') }}" method="post" id="comment-form">
                                    @csrf
									<div class="row">
										<div class="col-md-4">
											<label for="name">Name*</label>
											<input required="" id="name" value="{{ old('name') }}"  name="name" type="text">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
										<div class="col-md-4">
											<label for="mobile_or_email">Email or Mobile*</label>
											<input required id="mobile_or_email"  value="{{ old('mobile_or_email') }}" name="mobile_or_email" type="text">

                                            @error('mobile_or_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
                                        <div class="col-md-2">
                                            <label for="password">Password*</label>
                                            <input required id="password" name="password" type="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 

                                        <div class="col-md-2">
                                            <label required for="password">Repeat Password*</label>
                                            <input id="password" name="password_confirmation" type="password">
                                           
                                        </div>
									</div>
									<label for="comment">Write Comment*</label>
                                     <input type="hidden" name="news_id" value="{{ $get_news->id }}">
									<textarea id="comment" rows="2" name="comment">{{ old('comment') }}</textarea>
									<button required type="submit" id="submit-contact">
										<i class="fa fa-comment"></i> Post Comment
									</button>
								</form>
								@else
								<form action="{{route('comment_insert')}}"  method="get" id="comment">
									<label for="comment">Write Comment*</label>
                                    <input type="hidden" name="news_id" value="{{ $get_news->id }}">
									<textarea rows="2" required id="comment" required="" name="comment">{{ old('comment') }}</textarea>
									<button type="submit" id="submit-contact">
										<i class="fa fa-comment"></i> Post Comment
									</button>
								</form>
								@endif
							</div><br/>
							<!-- End contact form box -->

							@if(count($more_news)>0)
							<!-- more news box -->
							<div class="carousel-box owl-wrapper">
								<div class="title-section">
									<h1><span>More news on this section </span></h1>
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
                                                        <li><i class="fa fa-tags"></i>{{ ($news->subcategory) ? $news->subcategoryList->subcategory_en : $news->categoryList->category_en}}</li>

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

				<div class="col-sm-3" id="sticky-conent">
                    <div class="sidebar large-sidebar">
                       
    					 @include('frontend.en.layouts.sitebar')

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
<div id="loginModal" tabindex="-1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div style="text-align: center;">
        <h4 class="modal-title" >Login</h4>
            <span style="font-size: 12px">Not A Member Yet ? <a style="color:#b7020a;"  href="#mobile_or_email" data-dismiss="modal"> Sign Up Now!</a></span>
        </div>
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

            function readLater(news_id){

                 $.ajax({
                    url:'{{route("readLater")}}',
                    type:'GET',
                    data:{news_id:news_id},
                    success:function(response){
                       toastr.success(response);
                    }
                });
            }

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