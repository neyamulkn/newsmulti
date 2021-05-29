
<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category' || $section->section_type == 'country-wide'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   

$section_items = $section_items->orderBy('position', 'asc')->get();


?>

@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
   
            <div class="row">
             @foreach($section_items as $section_item)
                
                <div class="col-md-6">
                    @if($section_item->item_title)
                    <div class="title-section">
                        <h1><span> {{$section_item->item_title}} </span></h1>
                    </div>
                    @endif
                    <div class="row">
                        @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)

                            @if($index == 0)
                            <div class="col-md-6 col-sm-6">
                                <div class="news-post standard-post2 ">
                                    <a href="{{route('news_details', $section_news->news_slug)}}">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                            @if($section_news->type == 3)
                                                <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                            @elseif($section_news->type == 4)
                                                <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                            @else @endif
                                        </div>
                                        <div class="post-title box_title">
                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 90)}} </a></h2>
                                           
                                        </div>
                                    </a>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                            @elseif($index >= 0 && $index <= 4)
                                <div class="col-md-12">
                                    <ul class="list-posts">
                                        <li>
                                            <img src="{{ asset('upload/images/thumb_img/'.$section_news->image->source_path)}}" alt="">
                                            @if($section_news->type == 3)
                                                <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                            @elseif($section_news->type == 4)
                                                <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                            @else @endif
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 40)}}</a></h2>

                                                <ul class="post-tags">
                                                    @if($section_news->getCategory)
                                                    <li><i class="fa fa-tags"></i>{{$section_news->getCategory->category_bd}}</li>@endif
                                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @if($index == 4)
                            </div></div> @endif
                            @endif
                            @if($index > 4)
                            <div class="col-md-3 col-xs-6 col-sm-3">

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
                                            <div class="post-title" style="padding: 6px 3px !important;">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}} </a></h2>
                                                
                                            </div>
                                        </a>
                                    </div>
                            </div>
                            @endif
                        @endforeach
                
                </div>
            @endforeach
            </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
