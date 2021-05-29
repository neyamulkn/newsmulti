<input type="hidden" value="{{$data->id}}" name="id">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="ads_name">Ads Name</label>
            <input type="text" value="{{$data->ads_name}}"  name="ads_name"  id="ads_name" placeholder="Enter ads name" class="form-control" >
        </div>
    </div>
    

    <div class="col-md-12">
        <div class="form-group"><label for="adsType required">Select Advertisement Type</label><select name="adsType" onchange="adsTypes(this.value, 'edit')" required="required" id="adsType" class="form-control custom-select">
            <option value="">Select Type</option>
            <option @if($data->adsType == 'google') selected @endif value="google" > Google Adsense</option>
            <option @if($data->adsType == 'image') selected @endif value="image" >Image Ads</option>
            <option @if($data->adsType == 'others') selected @endif value="others">Others Ads</option>
        </select>
    </div>
    </div>
    <div class="col-md-12" id="editshowAdsType">
        @if($data->adsType == 'google')
        <div class="form-group"> <label class="required" for="add_code">Add code</label> <textarea name="add_code" class=" form-control" rows="5" id="add_code" placeholder="Enter ads code ...">{!! $data->add_code !!}</textarea> </div> 
        @elseif($data->adsType== 'image')
        <div class="form-group"><label class="dropify_image_area required">Add Images</label> <div class="form-group"> <input type="file" data-default-file="{{asset('upload/ads/'.$data->image)}}" name="image" id="input-file-now" class="dropify" /> </div> </div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" value="{{ $data->redirect_url }}" name="redirect_url"  id="redirect_url" class="form-control" > </div>
        @else
        <div class="form-group"> <label for="add_link required">Add code or link</label> <textarea name="add_code" class=" form-control" rows="3" id="add_link" placeholder="Enter ads code ...">{!! $data->add_code !!}</textarea></div><div class="form-group"> <label for="redirect_url">Redirect URL</label>  <input type="text" value="{{ $data->redirect_url }}" name="redirect_url"  id="redirect_url" class="form-control" > </div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="page">Select Page</label>
            <select name="page"  required="required" id="page" class="form-control custom-select">
                <option value="all">All page</option>
                @foreach($pages as $page)
                <option @if($data->page == $page->page_slug) selected @endif value="{{$page->page_slug}}">{{$page->page_name_en}}</option>
               @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="position">Select Position</label>
            <select name="position"  required="required" id="position" class="form-control custom-select">
                <option value="1" {{ ($data->position ==1) ? 'selected' : '' }}>All Page Right Of Menubar</option>

                <option value="2" {{ ($data->position ==2) ? 'selected' : '' }}>Right of the header</option>
                
                <option value="3" {{ ($data->position ==3) ? 'selected' : '' }}>Top Of the Content</option>
                <option value="4" {{ ($data->position ==4) ? 'selected' : '' }}>Middle Of the Content</option>
                <option value="5" {{ ($data->position ==5) ? 'selected' : '' }}>Bottom Of the Content</option>
                <option value="6" {{ ($data->position ==6) ? 'selected' : '' }}>Sidebar Top </option>
               <option value="7" {{ ($data->position ==7) ? 'selected' : '' }}>Sidebar Middle </option>

               <option value="8" {{ ($data->position ==8) ? 'selected' : '' }}>Sidebar Bottom </option>
              
               
            </select>
        </div>
    </div>
    <div class="col-md-12">

        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>

    </div>
</div>