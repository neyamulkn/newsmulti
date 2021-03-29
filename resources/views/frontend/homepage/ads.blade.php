
<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);
//check section type
if($section->section_type == 'ads'){
	$section_items->with('ads_details');
}

$section_items = $section_items->orderBy('position', 'asc')->get();


?>

@if(count($section_items)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
      	
      	<div class="row">
      		@foreach($section_items as $section_item)

      		<div class="col-md-{{ round(12/count($section_items)) }}">
      			<div class="advertisement">
                    <div class="desktop-advert">
                    	@if($section_item->ads_details)
                    	@if($section_item->ads_details->adsType == 'image')
                    	<a href="{{ $section_item->ads_details->redirect_url }}">
                    	<img style="width: 100%" src="{{ asset('upload/ads/'.$section_item->ads_details->image) }}" alt="">
                    	</a>
                    	@elseif($section_item->ads_details->adsType == 'google')
                        {!! $section_item->ads_details->add_code !!}
                        @else 
                        <a href="{{ $section_item->ads_details->redirect_url }}"></a>
                        {!! $section_item->ads_details->add_code !!}
                        @endif
                        @endif
                    </div>
                </div>
      		</div>
      		@endforeach
      	</div>
	    	
		@if($section->layout_width == 'box')
	</div>@endif
</section>
@endif
