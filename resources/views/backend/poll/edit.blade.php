<input type="hidden" value="{{$poll->id}}" name="id">
<div class="row" style="padding: 0;margin: 0">
    <div class="col-md-8 col-12 divrigth_border">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="title">Question Title</label>
                    <textarea  name="question_title" id="title" required="" class="form-control">{{ $poll->question_title }}</textarea>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required">Start Date</label>
                    <input type="text" class="form-control" value="{{ $poll->start_date }}" name="start_date">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required">End Date</label>
                    <input type="text" value="{{ $poll->end_date }}" class="form-control" name="end_date">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="name">Background Color</label>
                    <input type="text" value="{{ $poll->bg_color }}" name="bg_color"  class="form-control gradient-colorpicker" >
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="name">Text Color</label>
                    <input name="text_color" type="text" value="{{ $poll->text_color }}" class="gradient-colorpicker form-control" >
                </div>
            </div>

            <div class="col-md-6">
                <div class="head-label">
                    <label class="switch-box" style="margin-left: -12px; top:-12px;">Login Status</label>
                    <div  class="status-btn" >
                        <div class="custom-control custom-switch">
                            <input name="login_status"  type="checkbox" class="custom-control-input" @if($poll->login_status == 1) checked @endif id="login_status">
                            <label  class="custom-control-label" for="login_status">Required / Not Required </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="head-label">
                    <label class="switch-box" style="margin-left: -12px; top:-12px;">Status</label>
                    <div  class="status-btn" >
                        <div class="custom-control custom-switch">
                            <input name="status" checked  type="checkbox" class="custom-control-input" @if($poll->status == 1) checked @endif id="status">
                            <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="row form-group ">
            <span class="col-12">Write Options</span> 
            <div class="col-11"> <input type="text" class="form-control"  name="options[]"  placeholder="Enter option"> </div>  <div class="col-1"><button class="btn btn-success" type="button" onclick="pollOption('edit');"><i class="fa fa-plus"></i></button></div>
        </div>
        <div id="editpollOption"></div>
        <div class="row justify-content-md-center"><div class="col-md-8"> <span  style="margin-top: 10px; cursor: pointer;" class="btn btn-info btn-sm" onclick="pollOption('edit')"><i class="fa fa-plus"></i> Add More Option </span></div>
        </div>
    </div>
</div>