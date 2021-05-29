@extends('frontend.layouts.master')
@section('title', 'Edit profile')

@section('MetaTag')
    <meta name="name" content="{{ $user_details->name }}" />
    <meta name="description" content="Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World">

    <meta name="keywords" content="bdtype, bangla news, current News, bangla newspaper, bangladesh newspaper, online paper, bangladeshi newspaper, bangla news paper, bangladesh newspapers, newspaper, all bangla news paper, bd news paper, news paper, bangladesh news paper, daily, bangla newspaper, daily news paper, bangladeshi news paper, bangla paper, all bangla newspaper, bangladesh news, daily newspaper, web design, bangla paper, add post, how to use wordpress, wordpress add post, wordpress tutorials, adding wordpress post, wordpress posts, wordpress, wordpress tutorial, word press basics, wordpress basics, marketing, blogger (website), blog (industry), web design (interest), create wordpress, wordpress blog entry, wordpress blog, word press, wordpress (blogger), daily newspaper, bangladesh news, all bangla newspaper, wordpress user guide, bangladeshi news paper, daily news paper, daily, bangladesh news paper, news paper, bd news paper, all bangla news paper, newspaper, bangladesh newspapers, bangla news paper, bangladeshi newspaper, online paper, bangladesh newspaper, bangla newspaper, current news" />
    <meta name="robots" content="index,follow" />

@endsection

@section('css')
<link href="{{asset('backend')}}/dist/css/pages/floating-label.css" rel="stylesheet">

    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.sidebar a:hover {
  color: red;
}

.floating-labels .form-control{
	padding: 5px 10px;
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
	return Carbon\Carbon::parse($date)->format('d F, Y');
}
?>

    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span id="head-title"> Edit Profile</span>
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
		<div class="container section-body" >
			<div class="row">
				<div class="col-sm-3">
					@include('frontend.users.sidebar')
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12">
							<div class="advertisement">
		                        <div class="desktop-advert">
		                           {!! $topOfNews !!}
		                        </div>
                   			</div>
						</div>
					</div>

					
					<div class="">
						<div class="col-sm-12">
							<h3>Profile Information</h3>
							<div class="modal-body">
					            <form action="{{ route('user.profileUpdate') }}" enctype="multipart/form-data"  method="post">
					                @csrf
					                <div class="col-md-12">

			                            <label for="name">Name</label>
										<input required="" id="name" value="{{ $user_details->name }}"  name="name" class="form-control" type="text">
			                            @error('name')
			                                <span class="invalid-feedback" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror

				                    </div>

				                    <div class="col-md-12">

			                            <label for="email" >Email address</label>
			                            <input id="email" value="{{ $user_details->email }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

			                            @error('email')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                            @enderror

				                    </div>

				                    <div class="col-md-12">

			                            <label for="mobile">Mobile number</label>
			                            <input id="mobile" value="{{ $user_details->mobile }}" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" required >

			                            @error('mobile')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                            @enderror

				                    </div>

				                    <div class="col-md-6">

				                        <label for="gender" >Gender</label>
			                           	<select name="gender" id="gender" required="required" class="form-control @error('gender') is-invalid @enderror">
			                             	<option value="">Select Gender</option>
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

				                    <div class="col-md-6">

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
			                                    <input type="file" accept="image/*" data-show-remove="false" data-default-file="{{asset('upload/images/users/'. $user_details->photo)}}" name="image" id="input-file-disable-remove" class="dropify" />
			                                </div>
			                            </div>
				                    </div>

				                    <br/>

					                <button type="submit" class="btn btn-default">Update Now</button>
					            </form>
					        </div>
						</div>
					</div>

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
@endsection

@section('js')
   

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
