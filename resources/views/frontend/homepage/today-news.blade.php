<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 'active')->orderBy('id', 'desc')->limit(5); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])->orderBy('position', 'asc')->take(1)->get();
?>

@if(count($section_items)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
    <div class="container" style=" border-radius: 3px; padding:5px;">        
        <div class="row" >
         @foreach($section_items[0]->newsByCategory as $index => $section_news)
            @if($index == 0)
            <div class="col-md-4">
                <div class="news-post image-post default-size" style="background: #B90403; border-radius: 3px;padding: 8px;margin-top: -10px;margin-bottom: -5px;">
                    <p style="font-size: 16px; font-weight: 600; color:{{$section->text_color}} "><i class="fa fa-play-circle-o"></i> {{$section->title}}</p>
                    <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                    <a class="play-link" href="{{route('news_details', $section_news->news_slug)}}"><i class="fa fa-play-circle-o"></i></a>
                    <div class="hover-box">
                        <div class="inner-hover">
                            <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}}</a></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="feature-tab" style="border-bottom:1px dotted {{$section->text_color}}">
                    <ul>  
                        <li class="active"><a href="#">খবর</a></li>
                        <li><a href="#">ফিচার</a></li>
                        <li><a href="#">নিউজ ফ্ল্যাশ</a></li>
                    </ul>
                </div>
                <div class="row">
                @else
                    <div class="col-md-3 col-xs-6">
                        <div class="news-post standard-post2">
                           <a style="color: {{$section->text_color}};font-size: 14px;" href="{{route('news_details', $section_news->news_slug)}}">
                            <div class="post-gallery">
                                <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                            </div>
                            {{Str::limit($section_news->news_title, 40)}}
                            </a>
                        </div>
                    </div>
                @if($index == 4)    
                    <div class="col-md-12">
                        <a style="float: right;background:#B90403; margin-bottom: -3px;  padding: 12px 5px 7px 20px; border-top-left-radius: 60px; color: {{$section->text_color}}" href="{{url('video')}}">সকল ভিডিও দেখুন <i class="fa fa-arrow-right"></i></a>
                    </div>
                   
                </div>
            </div>
            @endif
            @endif
         @endforeach
        </div>
    </div>
</section>
@endif
