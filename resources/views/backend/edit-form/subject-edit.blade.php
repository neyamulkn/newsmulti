
<input type="hidden" value="{{$data->id}}" name="id">
<div class="col-md-12 mb-12">
    <label for="validationCustom01">subject Name</label>
    <input name="subject_name" value="{{$data->subject_name}}" type="text" class="form-control" id="validationCustom01" placeholder="subject name" >
    <div class="valid-feedback"></div>
</div>

<div class="col-md-12 mb-12">
    <label for="validationCustom02">Status</label>
    <div class="form-group">
        <select name="status" class="custom-select" required="">
            <option {{($data->status == 1) ?  'selected' : ''}} value="1">Active</option>
            <option  {{($data->status == 2)? 'selected' : ''}} value="2">Unactive</option>
        </select>
    </div>
</div>