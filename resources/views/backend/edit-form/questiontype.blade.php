
<input type="hidden" value="{{$data->id}}" name="id">
<div class="col-md-6 mb-6">
    <label for="validationCustom01">Question type Name</label>
    <input name="question_type" value="{{$data->question_type}}" type="text" class="form-control" id="validationCustom01" placeholder="question type name" >
    <div class="valid-feedback"></div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Input type</label>
        <select name="inputtype" required="" class="form-control custom-select">
            <option value="text" {{($data->inputtype  == 'text') ? "selected" : ""}}>Text</option>
            <option value="radio" {{($data->inputtype  == 'radio') ? "selected" : ""}}>Radio</option>
            <option value="textarea" {{($data->inputtype  == 'textarea') ? "selected" : ""}}>Textarea</option>
            <option value="checkbox" {{($data->inputtype  == 'checkbox') ? "selected" : ""}}>Checkbox</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Number of fields</label>
        <select name="fields" required="" class="form-control custom-select">
        @for($i=1; $i<6; $i++)
            <option value="{{$i}}" {{($data->fields  == $i) ? "selected" : ""}} >{{$i}}</option>
        @endfor
        </select>
    </div>
</div>

<div class="col-md-6 mb-6">
    <label for="validationCustom02">Status</label>
    <div class="form-group">
        <select name="status" class="custom-select" required="">
            <option {{($data->status == 1) ?  'selected' : ''}} value="1">Active</option>
            <option  {{($data->status == 2)? 'selected' : ''}} value="2">Unactive</option>
        </select>
    </div>
</div>