@extends('frontend.en.layouts.master')
@section('title')
    Video Gallery | Bdtype
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
                            <span class="breaking-news" id="head-title"> Video Gallery</span>
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
        	<?php $section = 1; ?>
        	@foreach($categories as $category)
        		<?php $videos = DB::table('news')
        			->join('categories', 'news.category', '=', 'categories.id')
        			->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        			->where('news.category', $category->id)
        			->where('news.type', 3)
        			->where('news.lang', 2)
        			->where('news.status', 1)
        			->select('news.*','media_galleries.source_path')->take(5)->get();
        		$i = 1;
                ?>
                	<div class="row">
                @foreach($videos  as $video)
	        		@if($i ==1)
				        	<div class="title-section">
							<h1><span class="video">{{$category->category_en}}</span></h1>
						</div>
			        @endif
			        	@if($i <=1 && $section <=1 )
			        	<?php $section++; ?>
						<div class="col-md-6">
							<div class="news-post video-post">
								<img alt="" src="{{ asset('upload/images/thumb_img/'. $video->source_path)}}">
								<a href="{{route('news_details', $video->news_slug)}}" class="play-link"><i class="fa fa-play-circle-o"></i></a>
								<div class="hover-box">
									<h2><a href="{{route('video.watch', [$video->news_slug])}}">{{Str::limit($video->news_title, 40)}} </a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i>{{banglaDate($video->publish_date)}}</li>
									</ul>
								</div>
							</div>
						</div>
						@else
						<div class="col-md-3">
							<div class="news-post video-post">
								<img alt="" src="{{ asset('upload/images/thumb_img/'. $video->source_path)}}">
								<a href="{{route('news_details', $video->news_slug)}}" class="play-link"><i class="fa fa-play-circle-o"></i></a>
								<div class="hover-box">
									<h2><a href="{{route('video.watch', [$video->news_slug])}}">{{Str::limit($video->news_title, 40)}}</a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i>{{banglaDate($video->publish_date)}}</li>
									</ul>
								</div>
							</div>
						</div>
						@endif
					<?php $i++; ?>
				@endforeach
					</div>
			@endforeach

		</div>

</section>
@endsection
