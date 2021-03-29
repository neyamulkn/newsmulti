<!-- ============================ Hero Banner  Start================================== -->
<div class="image-cover hero_banner shadow rlt bg-light">
	<div class="container">
		<!-- Type -->
		<div class="row align-items-center">
			<div class="col-lg-7 col-md-7 col-sm-12">
				<div class="banner-search-2 transparent">
					<h1 class="big-header-capt cl_2 mb-2 f_2">{{$section->title}}</h1>
					<p>{{$section->sub_title}}</p>
					<div class="mt-4">
						<a href="{{route('register')}}" class="btn btn-modern dark">Enroll Now<span><i class="ti-arrow-right"></i></span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-12">
				<div class="flixio">
                    <img class="img-fluid" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}" alt="">
                </div>
			</div>
		</div>
	</div>
</div>
<!-- ============================ Hero Banner End ================================== -->
