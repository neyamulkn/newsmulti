@extends('frontend.en.layouts.master')
@section('title')
    Image Gallery | বিডি টাইপ
@endsection
@section('Metatag') @endsection
<?PHP
function banglaDate($date){
		return Carbon\Carbon::parse($date)->format('d F, Y');

    }
?>
@section('content')
    <section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title">Image Gallery</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('frontend')}}/upload/addsense/add.jpg" height="45">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block-wrapper">

        <div class="container section-body">
        	<div class="single-post-box wide-version">
			<div class="article-inpost">
        	<?php $section = 1; ?>
        	@foreach($categories as $category)
        		<?php $galleries = DB::table('news')
        			->join('categories', 'news.category', '=', 'categories.id')
        			->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        			->where('news.category', $category->id)
        			->where('news.type', 2)
        			->select('news.*','media_galleries.source_path')->take(5)->get();
        		$i = 1;
                ?>
                	<div class="row">
                @foreach($galleries  as $gallery)
	        		@if($i ==1)
				        <div class="title-section">
							<h1><span class="video">{{$category->category_en}}</span></h1>
						</div>
			        @endif
			        	@if($i <=1 && $section <=1 )
			        	<?php $section++; ?>
						<div class="col-md-6">
							<div class="image-content news-post video-post">
								<div class="image-place">
									<img src="{{ asset('upload/images/thumb_img/'. $gallery->source_path)}}" alt="">
									<div class="hover-image">
										<a class="zoom" href="{{ asset('upload/images/'. $gallery->source_path)}}"><i class="fa fa-arrows-alt"></i></a>
									</div>
								</div>
								<div class="hover-box">
									<h2><a href="{{route('gallery.view', [$category->cat_slug_en, $gallery->news_slug])}}">{{Str::limit($gallery->news_title, 40)}}</a></h2>

								</div>
							</div>
						</div>
						@else

						<div class="col-md-3">
							<div class="image-content news-post video-post">
								<div class="image-place">
									<img src="{{ asset('upload/images/thumb_img/'. $gallery->source_path)}}" alt="">
									<div class="hover-image">
										<a class="zoom" href="{{ asset('upload/images/'. $gallery->source_path)}}"><i class="fa fa-arrows-alt"></i></a>
									</div>
								</div>
								<div class="hover-box">
									<h2><a href="{{route('gallery.view', [$category->cat_slug_en, $gallery->news_slug])}}">{{Str::limit($gallery->news_title, 40)}}</a></h2>

								</div>
							</div>
						</div>
						@endif
					<?php $i++; ?>
				@endforeach
					</div>
			@endforeach



</div>
</div>


		</div>

</section>
@endsection
