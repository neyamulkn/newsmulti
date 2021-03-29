
<?php  

$section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1);
//check section type
if($section->section_type == 'news'){
	$section_items->with(['news' => function ($query) {
    $query->where('status', '=', 'active'); }]);
}

if($section->section_type == 'category' || $section->section_type == 'country-wide'){
	$section_items->with(['newsByCategory' => function ($query) {
    $query->where('status', '=', 1)->limit(9); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en']);
}	

$section_items = $section_items->orderBy('position', 'asc')->get();


?>

@if(count($section_items)>0 || $section->is_default == 1)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
      	
      	<!-- here section -->
	    	
		@if($section->layout_width == 'box')
	</div>@endif
</section>
@endif
