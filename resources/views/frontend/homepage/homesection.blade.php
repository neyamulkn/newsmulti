<?php
	// this function only ajax load
	if(isset($ajaxLoad)){
	    function banglaDate($date){
	        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

	        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
	        $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
	        $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
	        return $convertedDATE;
	    }
	}
    ?>
@if(count($sections) > 0)
@foreach($sections as $section)
	@if($section->section_type != 'category')
		@include('frontend.homepage.'.$section->section_type)
	@else
		@include('frontend.homepage.'.$section->section_layout)
	@endif
@endforeach 
@endif
