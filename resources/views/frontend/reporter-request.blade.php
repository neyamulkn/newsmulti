@extends('frontend.layouts.master')
@section('title')
    Reporter request | বিডি টাইপ
@endsection
@section('MetaTag')
    <meta name="name" content="{{ $user_details->name }}" />
    <meta name="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">

    <meta name="keywords" content="bdtype, bangla news, current News, bangla newspaper, bangladesh newspaper, online paper, bangladeshi newspaper, bangla news paper, bangladesh newspapers, newspaper, all bangla news paper, bd news paper, news paper, bangladesh news paper, daily, bangla newspaper, daily news paper, bangladeshi news paper, bangla paper, all bangla newspaper, bangladesh news, daily newspaper, web design, bangla paper, add post, how to use wordpress, wordpress add post, wordpress tutorials, adding wordpress post, wordpress posts, wordpress, wordpress tutorial, word press basics, wordpress basics, marketing, blogger (website), blog (industry), web design (interest), create wordpress, wordpress blog entry, wordpress blog, word press, wordpress (blogger), daily newspaper, bangladesh news, all bangla newspaper, wordpress user guide, bangladeshi news paper, daily news paper, daily, bangladesh news paper, news paper, bd news paper, all bangla news paper, newspaper, bangladesh newspapers, bangla news paper, bangladeshi newspaper, online paper, bangladesh newspaper, bangla newspaper, current news" />
    <meta name="robots" content="index,follow" />

@endsection

@section('css')
<link href="{{asset('backend')}}/dist/css/pages/floating-label.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.sidebar a:hover {
  color: red;
}

.floating-labels .form-control{
	padding: 0px 10px;
}
.floating-labels label{
	background: #fff;
}

@media (max-width: 991px){

.sidebar.small-sidebar {
    display: block;
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
@endsection
@section('content')
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'user_profile')->where('status', 1)->get();
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

    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span id="head-title"> {{$user_details->name}} Profile</span>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        {!! $top_head_right !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

	<section class="block-wrapper">
		<div class="container section-body" >
			<div class="row">
				<div class="col-sm-3">
					<div class="sidebar ">
						<div class=" review-widget">
							<ul class="review-posts-list">
								<li style="height: 200px;cursor: pointer" data-toggle="modal" data-target="#update_profile">
									<img style="max-width: 100%;max-height: 100%; object-fit: contain;" src="{{asset('upload/images/users/thumb_image/'. $user_details->image)}}" alt="">
								</li>
							</ul>
						</div>
						<div class="widget categories-widget">
							<ul class="category-list user-profile">
								@if(Auth::check() && Auth::user()->id == $user_details->id)
									<li class="profile">
										<a style="cursor: pointer" data-toggle="modal" data-target="#update_profile" ><i class="fa fa-user" aria-hidden="true"></i>  Profile <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
									</li>
									
									<li>
										<a href="#"><i class="fa fa-fw fa-envelope"></i> Messages  <span>0</span></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-fw fa-bell"></i> Notifications  <span>0</span></a>
									</li>
								@endif
								
								<li>
									<a style="cursor: pointer" @if(Auth::check()) data-toggle="modal" data-target="#request_reporter" @else href="{{route('login')}}" @endif ><i class="fa fa-fw fa-user"></i> Request For Reporter  </a>
								</li>
							
								
								<li>
									<a href="#"><i class="fa fa-fw fa-envelope"></i> All News <span>({{$total_Engnews+$total_Bdnews}})</span></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-fw fa-user"></i> Bangla News <span>({{$total_Bdnews}})</span></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-fw fa-user"></i> English News <span>({{$total_Engnews}})</span></a>
								</li>

								<li>
									<a href="{{route('viewReadLater', $user_details->username)}}"><i class="fa fa-book"></i> Read Later <span>({{$read_laters}})</span></a>
								</li>

								<li>
									<a href="#"><i class="fa fa-line-chart"></i> Level  <span>0</span></a>
								</li>

								<li>
									<a href="#"><i class="fa fa-fw fa-user"></i> My Point  <span>0</span></a>
								</li>
								@if(Auth::check())
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>
                                    <!-- text-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12">
							<h1>Notice</h1>
						</div>
					</div>
					<div class="">
						<div class="col-sm-12">
							<h3>Profile Information</h3>
							<table class="table">
							    <tbody>
							      	<tr> <td>Name:- {{ $user_details->name }}</td> </tr>
							        <tr><td>Email:- {{ $user_details->email }}</td>  </tr>
							        <tr><td>Mobile:- {{ $user_details->phone }}</td></tr>
							        <tr><td>Gender:-  @if($user_details->gender ==1 ) Male @elseif($user_details->gender == 2) Female @else Others @endif</td></tr>
							        <tr><td>Birthday:- {{ banglaDate($user_details->birthday) }} </td></tr>
							    </tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-sm-3 div_border">
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
	@if(Auth::check() && $user_details->id == Auth::user()->id)
	<!-- Modal -->
	<div id="update_profile" tabindex="-1" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <div style="text-align: center;">
			        <h4 class="modal-title" >Update Profile</h4>
			        </div>
		      	</div>
		      	<div class="modal-body">
		            <form action="{{ route('update_profile') }}" enctype="multipart/form-data" class="floating-labels" method="post">
		                @csrf
		                <div class="form-group">

	                            <label for="name">Name</label>
								<input required="" id="name" value="{{ $user_details->name }}"  name="name" class="form-control" type="text">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

	                    </div>

	                    <div class="form-group ">

                            <label for="email" >Email address</label>
                            <input id="email" value="{{ $user_details->email }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

	                    </div>

	                    <div class="form-group ">

                            <label for="phone" >Mobile number</label>
                            <input id="phone" value="{{ $user_details->phone }}" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required >

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

	                    </div>

	                    <div class="form-group">

	                        <label for="gender" >Gender</label>
                           	<select name="gender" id="gender" required="required" class="form-control @error('gender') is-invalid @enderror">
                             	<option value=""></option>
                             	<option value="1" @if($user_details->gender ==1) selected @endif >Male</option>
                             	<option value="2"  @if($user_details->gender ==2) selected @endif >Female</option>
                             	<option value="3"  @if($user_details->gender ==3) selected @endif >Others</option>
                           	</select>

                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

	                    </div>

	                    <div class="form-group">

                            <label for="birthday">Birthday date</label>
                            <input  value="{{$user_details->birthday}}" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" required autocomplete="birthday" autofocus>

                            @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

	                    </div>
	                     <div class="form-group ">
                            <div class="head-label">
                                <span class="dropify_image_area">Images</span>
                                <div class="form-group">
                                    <input type="file" data-show-remove="false" data-default-file="{{asset('upload/images/users/thumb_image/'. $user_details->image)}}" name="image" id="input-file-disable-remove" class="dropify" />
                                </div>
                            </div>
	                    </div>

	                    <br/>

		                <button type="submit" class="btn btn-default">Update Now</button>
		            </form>
		        </div>
		    </div>
		</div>
	</div>
	@endif
	@if(Auth::check())
	<div id="request_reporter" tabindex="-1" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <div style="text-align: center;">
			        <h4 class="modal-title" >Request For Reporter</h4>
			        </div>
		      	</div>
		      	<div class="modal-body">
		            <form action="{{route('reporter.store')}}" class="floating-labels" enctype="multipart/form-data" method="post" id="reporter">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="reporter_name">Reporter Name</label>
                                        <input type="text" value="{{old('reporter_name')}}"  required="required" name="reporter_name"  id="reporter_name" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" value="{{ old('phone') }}" required="required" name="phone"  id="phone" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  type="email" value="{{ old('email') }}" required name="email"  id="email" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select required name="gender"  id="gender" class="form-control custom-select">
                                            <option></option>
                                            <option value="1" {{ (old('gender') ==1) ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ (old('gender') ==2) ? 'selected' : '' }}>Female</option>
                                            <option value="3" {{ (old('gender') ==3) ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="control-label">Birth Date</label>
                                        <input required name="birthday" value="{{ old('birthday') }}"  id="birthdate" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Fathers">Fathers Name</label>
                                        <input required type="text" value="{{ old('father_name') }}"  name="father_name"  id="Fathers" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mothers">Mothers Name</label>
                                        <input required type="text"   value="{{ old('mother_name') }}" name="mother_name"  id="Mothers" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="Present">Present Address</label>
                                        <textarea required name="present_address" value="{{ old('present_address') }}" id="Present"  class="form-control"  rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="Permanent">Permanent  Address</label>
                                        <textarea required="" name="permanent_address" value="{{ old('permanent_address') }}" id="Permanent"  class="form-control"  rows="2"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national"  class="control-label">National Id</label>
                                        <input name="national_id" value="{{ old('national_id') }}" id="national" type="number" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="head-label">
                                        <span class="dropify_image_area">Recent Phato</span>
                                        <div class="form-group">
                                            <input type="file" name="image" id="input-file-now" class="dropify" />
                                        </div>
                                    </div>
                                </div><div class="col-md-12">
                                    <div class="head-label">
                                        <span class="dropify_image_area">Attach Resume</span>
                                        <div class="form-group">
                                            <input type="file" name="resume" id="input-file-now" class="dropify" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><hr>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>Save</button>

                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
                        </div>
                    </form>
		        </div>
		    </div>
		</div>
	</div>
	@endif
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
    </script>

     <!-- for label -->
  <script type="text/javascript">
    $(".floating-labels .form-control").on("focus blur",function(e){$(this).parents(".form-group").toggleClass("focused","focus"===e.type||0<this.value.length)}).trigger("blur")
  </script>
<!--end label -->


<script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
@endsection
