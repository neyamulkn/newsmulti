<input type="hidden" value="{{$section->id}}" name="id">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Section Title</label>
            <input  name="title" id="name" value="{{$section->title}}" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="sub_title">Sub Title</label>
            <input  name="sub_title" id="sub_title" value="{{$section->sub_title}}" type="text" class="form-control">
        </div>
    </div>

    @if($section->section_type == 'category')
    <div class="col-md-6">
        <div class="form-group">
            <label for="name required">Section Layout</label>
            <select required name="section_layout" class="form-control">
                
                @for($i=1; $i<=6; $i++)
                <option value="layout-{{$i}}"  @if($section->section_layout == 'layout-'.$i) selected @endif>Layout {{$i}}</option>
                @endfor
                
            </select>
        </div>
    </div>
    @endif
    @if($section->section_layout == 1)
    <div class="col-md-6">
        <div class="form-group">
            <label for="name required">Select Category</label>
            <select required name="category_id" class="form-control select2">
                
                @foreach($categories as $category)
                <option value="{{$category->id}}"  @if($section->sectionItem->item_id == $category->id) selected @endif>{{ $category->category_bd }}</option>
                @endforeach
                
            </select>
        </div>
    </div>
    @endif


    
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Number Of Item</label>
            <input type="number" value="{{$section->item_number}}" class="form-control" placeholder="Example: 7" name="item_number">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Section Width</label>
            <select name="layout_width" class="form-control">
                <option @if($section->layout_width == 'box') selected @endif value="box">Box width</option>
                <option @if($section->layout_width == 'full') selected @endif value="full">Full width</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="name">Bacground Color</label>
            <input name="background_color" value="{{$section->background_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="name">Text Color</label>
            <input name="text_color" value="{{$section->text_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
          
    <div class="col-md-6">
        <div class="form-group"> 
            <label class="dropify_image">Background image</label>
            <input data-default-file="{{asset('upload/images/homepage/'.$section->background_image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="background_image" id="input-file-events">
            <i class="info">Recommended size: 1250px*300px</i>
        </div>
        @if($errors->has('background_image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('background_image') }}
            </span>
        @endif
    </div>     

    <div class="col-md-6">
        <div class="form-group"> 
            <label class="dropify_image">Tumbnail Image</label>
            <input data-default-file="{{asset('upload/images/homepage/'.$section->thumb_image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
            <i class="info">Recommended size: 300px*250px</i>
        </div>
        @if($errors->has('thumb_image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('thumb_image') }}
            </span>
        @endif
    </div>   
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Image Position</label>
            <select name="image_position" class="form-control">
                <option @if($section->image_position == 'left') selected @endif value="left">Left</option>
                <option @if($section->image_position == 'center') selected @endif value="center">Center</option>
                <option @if($section->image_position == 'right') selected @endif value="right">Right</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($section->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>

    </div>
</div>
