<?php  

$get_english_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    // ->where('news.breaking_news', 1)
    ->limit(4)
    ->orderBy('news.id', 'DESC')
    ->where('news.status', '=', 'active')->where('news.lang', 'en')->select('news.*', 'categories.category_bd', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();
?>

@if(count($get_english_news)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; " @endif>
    
    <div class="container" style="padding: 10px 0;">
        <div class="row" >
            <div class="col-md-3">
            	<div style="height: 180px; overflow: hidden;">
                <img style="width: 100%;height: 100%" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
            	</div>
            </div>
           
            <div class="col-md-9">
                <div class="row">
            		@foreach($get_english_news as $index => $section_news)
                    <div class="col-md-3 col-xs-6">
                        <div class="news-post standard-post2" style="border: 2px solid red;border-radius: 5px;">
                            <div class="post-gallery">
                                <img src="{{ asset('upload/images/thumb_img/'. $section_news->source_path)}}" alt="">
                            </div>
                            <div style="height: 62px;background:#fff;padding: 5px;">
                            <a style="color: {{$section->text_color}};font-size: 14px;" href="{{route('news_details', $section_news->news_slug)}}">
                            {{Str::limit($section_news->news_title, 50)}}
                            </a>
                        	</div>
                        </div>
                    </div>
                   	@endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
