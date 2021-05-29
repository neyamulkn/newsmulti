<input type="hidden" value="{{$data->id}}" name="id">

<div class="row">
    <div class="col-md-12">
        <input type="hidden" value="{{$data->id}}" name="id">
        <div class="form-group">
            <h4 class="card-title">Drop files anywhere to upload</h4>
            <input type="file" name="photo" id="input-file-events" data-default-file="{{asset('upload/images/'.$data->source_path)}}" class="dropify" />
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <span for="edittitle">Title</span>
            <input type="text" value="{{$data->title}}"  name="title"  id="edittitle" class="form-control" >
        </div>
    </div>
</div>