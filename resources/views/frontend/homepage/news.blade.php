<!-- ============================ Featured newss Start ================================== -->
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
  <div class="container"style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
      news
    @if($section->layout_width == 'box')
    </div>@endif
</section>
  <!-- ============================ Featured newss End ================================== -->
  