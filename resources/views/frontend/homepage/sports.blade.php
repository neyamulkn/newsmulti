<?php  
$item_number = $section->item_number;
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)
    ->with(['newsByCategory' => function ($query) use ($item_number) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc')->limit($item_number); }, 'category:id,cat_slug_en', 'newsByCategory.image','newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en', 
        'getCategories' => function ($query) {
    $query->where('status', '=', 'active')->limit(5); }]);

    $section_items = $section_items->orderBy('position', 'asc')->take(1)->get();

    $communications =  DB::table('news')
        ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        ->limit(6)
        ->inRandomOrder()->where('news.status', '=', 'active')
       	->where('news.lang', '=', 'bd')
        ->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->get();
?>
@if(count($section_items)>0 && count($section_items[0]->newsByCategory)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>


  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
        <div class="row">
            <div class="col-md-9 section-body divrigth_border" id="sticky-conent">
            	@if($section->title)
                <div class="title-section">
                <h1 class="row" style=" box-shadow: 0 0 5px -3px rgb(0 0 0);background: #F0F0F0;">
                    <span class="col-md-3 col-xs-12" style="padding: 10px;margin: 0"> {{$section->title}} </span> 
                	@if(count($section_items[0]->getCategories)>0)
                	<span class="col-md-8 col-xs-12 feature-tab" style="background:transparent;border:0;  float: right; text-align: right;padding: 0">
                		<ul>  
	                	@foreach($section_items[0]->getCategories as $subcategory)
	                	<li style="background: transparent;border-left: 1px solid #fff;"><a style="color:#000;font-size: 12px;" href="{{route('category', [$section_items[0]->category->cat_slug_en, $subcategory->subcat_slug_en])}}"> {{$subcategory->subcategory_bd}} </a></li>
	                	@endforeach
	                	</ul>
	                </span>
	                @endif
	            </h1>
                </div>
            	@endif
                @if(count($section_items)>0)
                <div class="row">
                    <div class="grid-box">
                        @foreach($section_items[0]->newsByCategory as $index => $section_news)
                            @if($index== 0)

                                <div class="col-md-7 col-sm-6">
                                    <div class="news-post image-post2">
									    <div class="post-gallery">
									        <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
									        <div class="hover-box">
									        <div class="inner-hover">
									        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}}</a></h2>

									        </div>
									        </div>
									    </div>
									</div>
                                </div>
                            @elseif($index >= 0 && $index <= 4)
                            <div class="col-md-5">
								    <ul class="list-posts">
								        <li  style="padding: 5px 3px !important;">
                                            <div class="col-md-4 col-xs-4">
								            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                            </div>
                                            <div class="col-md-8 col-xs-8">
								            <div class="post-content">
								                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}}</a></h2>
								                <ul class="post-tags">
			                                       
			                                      @if($section_news->subcategoryList)
                                    				<li><i class="fa fa-tags"></i>{{$section_news->subcategoryList->subcategory_bd}}</li>@endif
			                                    </ul>
								            </div>
                                            </div>
								        </li>
								    </ul>
								</div>
                            	
                            @else
                                <div class="col-md-3 col-xs-6 col-sm-4">
                                    <div class="news-post standard-post2">
                                        <a href="{{route('news_details', $section_news->news_slug)}}">
                                            <div class="post-gallery">
                                                <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-title">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}} </a></h2>
                                                
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                           
                        @endforeach
                    </div>
                </div>
                @endif
                
            </div>
            <div class="col-md-3 section-body" id="sticky-conent">
                
                <div class="sidebar large-sidebar">
	                <div class="title-section">
                        <h1><span>মতামত </span></h1>
                    </div>
                    @foreach($communications as $communication)
                	<div class="col-md-12">
					    <ul class="list-posts">
					        <li>
					            <img style="border-radius: 50%;width: 65px;height: 65px;" src="{{ asset('upload/images/thumb_img/'. $communication->source_path)}}" alt="">
					            <div class="post-content">
					                <h2 style=""><a href="{{route('news_details', $communication->news_slug)}}">{{Str::limit($communication->news_title, 45)}}</a></h2>
					                
					            </div>
					        </li>
					    </ul>
					</div>
                    @endforeach
                </div>
                
            </div>
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
