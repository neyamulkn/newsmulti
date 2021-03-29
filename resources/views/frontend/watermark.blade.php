<figure>
  <img class="image" src="{{asset('upload/images/thumb_img_box/'.$path)}}" alt="image" />
</figure>
<script type="text/javascript" src="{{asset('frontend/js')}}/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('frontend/js')}}/jquery.watermark.min.js"></script>
<script>
  $(function(){
   $('.image').watermark({
    path: '{{asset("frontend/images")}}/watermark.png',
    gravity: 's',
    opacity: 0.7,
   
    margin: 0
  });
})
</script>