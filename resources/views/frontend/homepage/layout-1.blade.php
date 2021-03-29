
<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 1)->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   

$section_items = $section_items->orderBy('position', 'asc')->get();

?>

@if(count($section_items)>0)
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
                <?php $i = 1;?>
                <div class="row">
                @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)
                @if($i==1)
                    <div class="col-md-7">
                        <div class="news-post image-post2">
                            <div class="post-gallery">
                                <img src="{{ asset('upload/images/thumb_img_box/'. $section_news->image->source_path)}}"  alt="">
                                <div class="hover-box">
                                    @if($section_news->type == 3)
                                        <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                    @elseif($section_news->type == 4)
                                        <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                    @else @endif
                                    <div class="inner-hover">
                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 60)}} </a></h2>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($i>1 && $i<=4)
                        <div class="col-md-5">
                            <ul class="list-posts">
                                <li style="padding: 8px 3px !important">
                                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                    <div class="post-content">
                                        <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 40)}}</a></h2>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="col-md-3 col-xs-6">
                            <div class="news-post standard-post2">
                                <div class="post-gallery">
                                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">

                                </div>
                                <div class="post-title">
                                    <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 40)}} </a></h2>
                                    
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php $i++; ?>
                @endforeach
        
                </div>
            </div>
            @endforeach
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
