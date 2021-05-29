<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
$query->where('status', '=', 'active')->orderBy('id', 'desc')->limit(11); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])->orderBy('position', 'asc')->take(1)->get();

$coronas =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->limit(5)
    ->orderBy('news.id', 'desc')
    ->where('categories.cat_slug_en', 'corona-update')->where('news.status', '=', 'active')
    ->where('news.lang', '=', 'bd')
    ->select('news.*', 'media_galleries.source_path', 'media_galleries.title')->get();

?>

@if(count($section_items)>0 && count($section_items[0]->newsByCategory)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>


  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        
        <div class="row">
            <div class="col-md-9  section-body divrigth_border" id="sticky-conent">
            	@if($section->title)
                <div class="title-section">
                <h1><span style="width: 70%;"> {{$section->title}} </span> <span style="float: right;width: 30%;text-align: right;background: red;"><a style="color:#fff" href="#"> See more </a></span></h1>
                </div>
            	@endif
                @if(count($section_items)>0)
                <div class="row">
                    <div class="grid-box">
                        @foreach($section_items[0]->newsByCategory as $index => $section_news)
                            @if($index== 0)

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
                            @elseif($index >= 0 && $index <= 4)
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
                                            <div class="post-title" style="padding: 3px 5px !important">
                                                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 55)}} </a></h2>
                                                
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4 col-xs-6">
								    <ul class="list-posts">
								        <li>
                                            <div class="col-md-5 col-xs-12">
								            <img src="{{ asset('upload/images/thumb_img/'. $section_news->image->source_path)}}" alt="">
                                            </div>
                                            <div class="col-md-7 col-xs-12">
								            <div class="post-content">
								                <h2><a href="{{route('news_details', $section_news->news_slug)}}">{{Str::limit($section_news->news_title, 45)}}</a></h2>
								                
								            </div>
                                            </div>
								        </li>
								    </ul>
								</div>
                            @endif
                           
                        @endforeach
                    </div>
                </div>
                @endif
                
            </div>
            <div class="col-md-3 section-body" id="sticky-conent">

                <div class="sidebar large-sidebar">
                    <div class="row" style="background: linear-gradient(143deg, #4065b1, transparent);display: block;margin: 5px;">
                        <h1 style="background: #005d2eba; font-size: 20px;margin: 0px 0; padding: 10px;color: #fff;"><span>করোনায় করণীয় </span></h1>
                    
                        @foreach($coronas as $corona)
                        <div class="col-md-12">
                            <ul class="list-posts">
                                <li style="background: transparent;padding: 6px 0 !important">
                                    <img style="border-radius: 50%;width: 65px;height: 65px;" src="{{ asset('upload/images/thumb_img/'. $corona->source_path)}}" alt="">
                                    <div class="post-content">
                                        <h2 style=""><a href="{{route('news_details', $corona->news_slug)}}">{{Str::limit($corona->news_title, 45)}}</a></h2>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                    </div>
                </div>
                
                <div class="sidebar large-sidebar">
                    <div class="widget features-slide-widget">
                        <div class="title-section">
                            <h1><span>সময় মতামত জরিপ</span></h1>
                        </div>
                         
                        <div  style="height: 235px;background: #000;margin:0 5px; padding: 3px 10px;">
                            <form action="{{url('/')}}" method="get" class="">
                               <h2 style="font-size: 18px;line-height: initial;"><a href="{{url('poll')}}">ঢাকা আন্তর্জাতিক বাণিজ্য মেলায় প্রবেশের টিকিটের মূল্যবৃদ্ধির সিদ্ধান্ত যৌক্তিক বলে মনে করেন কি?</a></h2>
                               <p style="color:#fff;">
                                <input type="radio" name="poll"> হ্যাঁ 
                                <input type="radio" name="poll"> না
                                <input type="radio" name="poll"> মন্তব্য নেই
                            </p>
                            <p><button class="btn btn-info">মতামত দিন</button></p>
                                <ul class="post-tags">
                                    <li><i class="fa fa-eye"></i>৫৩৪</li>

                                    <li> মতামত দিয়েছেন ৩৩০ জন</li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
