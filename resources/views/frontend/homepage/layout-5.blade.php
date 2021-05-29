
<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);

if($section->section_type == 'category'){
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

                <div class="col-md-3 col-xs-6 divrigth_border" style="background:{{$section->background_color}}; color:{{$section->text_color}}">
                    @if($section_item->item_title)
                    <div class="title-section">
                    <h1><span> {{$section_item->item_title}} </span></h1>
                    </div>
                    @endif
                    <div class="row">
                        @foreach($section_item->newsByCategory->take($section->item_number) as $index => $section_news)
                            @if($index == 0)
                                <div class="col-md-12">
                                    <div class="item news-post standard-post" style="margin:0px;border-bottom: 1px dotted #ccc;">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                        </div>
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 80)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="item news-post standard-post" style="margin: 0; border-bottom: 1px dotted #ccc;">
                                        <div class="post-content">
                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 80)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                        
                    </div>
                </div>
            @endforeach
            </div>

        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
