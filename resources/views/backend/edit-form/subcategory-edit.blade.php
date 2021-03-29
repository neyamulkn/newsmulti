
<input type="hidden" value="{{$data->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="bangla">Bangla SubCategory</label>
        <input  name="subcategory_bd" id="bangla" value="{{$data->subcategory_bd}}" required="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="english">English SubCategory</label>
        <input  name="subcategory_en" id="english" value="{{$data->subcategory_en}}" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="Category">Category name</label>
        <select name="category_id" id="Category" class="form-control custom-select">
            @foreach($get_category as $category)
                <option value="{{$category->id}}" {{($category->id == $data->category_id) ?  'selected' : ''}}>{{$category->category_bd}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-12 mb-12">

    <div class="head-label">
        <label class="switch-box">Status</label>
        <div  style="padding:0px 1px 13px 40px" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status">
                <label style="padding: 8px 15px;"  class="custom-control-label" for="status">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

