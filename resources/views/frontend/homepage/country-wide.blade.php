<?php  
$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);
if($section->section_type == 'category' || $section->section_type == 'country-wide'){
    $section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'DESC')->limit(9); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}   
$section_items = $section_items->orderBy('position', 'asc')->get();

?>

@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
            <div class="row">
                <div class="col-md-9 divrigth_border" id="sticky-conent">
                    <div class="title-section">
                        <h1><span>{{$section->title}} </span></h1>
                    </div>

                    <div class="row">
                        <?php $i = 1;?>
                        @foreach($section_items[0]->newsByCategory as $section_news)
                            @if($i==1)
                                <div class="col-md-6">
                                    <div class="news-post image-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}"  alt="">
                                            <div class="hover-box">
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                                <div class="inner-hover">
                                                    <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 60)}} </a></h2>
                                                    <ul class="post-tags">
                                                        @if($section_news->subcategoryList)
                                                        <li><i class="fa fa-tags"></i>{{$section_news->subcategoryList->subcategory_bd}}</li>
                                                        @else
                                                        @if($section_news->getCategory)
                                                        <li><i class="fa fa-tags"></i>{{$section_news->getCategory->category_bd}}</li>
                                                        @endif
                                                        @endif
                                                        <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($i>1 && $i<=5)
                                <div class="col-md-6 col-xs-6">
                                    <ul class="list-posts">
                                        <li style="padding: 8px 3px !important">
                                            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                            <div class="post-content">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 40)}}</a></h2>
                                                <ul class="post-tags">
                                                    @if($section_news->subcategoryList)
                                                    <li><i class="fa fa-tags"></i>{{$section_news->subcategoryList->subcategory_bd}}</li>
                                                    @else
                                                    @if($section_news->getCategory)
                                                    <li><i class="fa fa-tags"></i>{{$section_news->getCategory->category_bd}}</li>
                                                    @endif
                                                    @endif
                                                    <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                                                </ul>
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
                                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 60)}} </a></h2>
                                            <ul class="post-tags">
                                                @if($section_news->subcategoryList)
                                                <li><i class="fa fa-tags"></i>{{$section_news->subcategoryList->subcategory_bd}}</li>
                                                @else
                                                @if($section_news->getCategory)
                                                <li><i class="fa fa-tags"></i>{{$section_news->getCategory->category_bd}}</li>
                                                @endif
                                                @endif
                                                <li><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 sidebar  map">
                    <div class="title-section">
                        <h1><span>{{$section->sub_title}}</span></h1>
                    </div>
                    <div class="map">
                        @include('frontend.map');
                    </div>
                    @include('frontend.layouts.deshjure')
                </div>
            </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
