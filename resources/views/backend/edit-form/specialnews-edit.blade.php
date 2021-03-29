

<input type="hidden" value="{{$data->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <input name="speciality_name" value="{{$data->speciality_name}}" required="" type="text" class="form-control">
        <span class="bar"></span>
        <label>Speciality name</label>
    </div>
</div>
<div class="col-md-12 mb-12">

    <div class="form-group">
        <select name="status" class="custom-select" required="">
            <option {{($data->status == 1) ?  'selected' : ''}} value="1">Active</option>
            <option  {{($data->status == 2)? 'selected' : ''}} value="2">Unactive</option>
        </select>
        <span class="bar"></span>
        <label>Status</label>
    </div>
</div>
