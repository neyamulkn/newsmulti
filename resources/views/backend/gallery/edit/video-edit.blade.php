<input type="hidden" value="{{$data->id}}" name="id">

<div class="row">
    <div class="col-md-12">
        <input type="hidden" value="{{$data->id}}" name="id">
        <div class="form-group">
            <h4 class="card-title">Drop files anywhere to upload</h4>
            <input type="file" name="video" id="input-file-events" data-default-file="{{asset('upload/videos/'.$data->source_path)}}" class="dropify" />
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{$data->title}}"  name="title"  id="title" class="form-control" >
        </div>
    </div>
</div>
