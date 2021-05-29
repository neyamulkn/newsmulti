
<input type="hidden" value="{{$data->id}}" name="id">
<div class="col-md-12">
    <div class="form-group">
        <label for="bangla">Bangla Category</label>
        <input  name="category_bd" id="bangla" value="{{$data->category_bd}}" required="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="english">English Category</label>
        <input  name="category_en" id="english" value="{{$data->category_en}}" required="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <span class="required" for="meta_title">Meta Title</span>
        <input type="text" value="{{$data->meta_title}}"  name="meta_title" id="meta_title" placeholder = 'Enter meta title'class="form-control" >
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <span>Keywords</span>
         <div class="tags-default">
            <input type="text" class="form-control tagsinput" value="{{$data->keywords}}" name="keywords[]"  data-role="tagsinput" placeholder="add keywords" />
        </div>
   
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <span class="required">Meta Tags( <span style="font-size: 12px;color: #777;font-weight: initial;">Write meta tags Separated by Comma[,]</span> )</span>

         <div class="tags-default">
            <input class="form-control tagsinput" type="text" value="{{$data->meta_tags}}" name="meta_tags[]"  data-role="tagsinput" placeholder="Enter meta keywords" />
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <span class="control-label" for="meta_description">Meta Description</span>
        <textarea class="form-control" name="meta_description" id="meta_description" rows="2" style="resize: vertical;" placeholder="Enter Meta Description">{{$data->meta_description}}</textarea>
    </div>
</div>
<div class="col-md-12 mb-12">

    <div class="head-label">
        <label class="switch-box">Status</label>
        <div  style="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="editstatus">
                <label style="padding: 8px 15px;"  class="custom-control-label" for="editstatus">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

