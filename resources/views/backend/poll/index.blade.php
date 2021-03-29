@extends('backend.layouts.master')
@section('title', 'Poll list')

@section('css-top')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />

@endsection
@section('css')
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999}
        .select2-container--default .select2-selection--multiple .select2-selection__rendered{height: 100px!important}
        .dropify-wrapper{height: 120px;}
    </style>
@endsection
@section('content')
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Poll List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">homepage</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="#" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="seller" required id="seller" style="width:100%" id="seller"  class="select2 form-control custom-select">
                                                       <option value="all">Repoter All</option>
                                                       @foreach($reporters as $repoter)
                                                       <option value="{{$repoter->id}}">{{$repoter->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div> -->

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="deactive" {{ (Request::get('status') == 'deactive') ? 'selected' : ''}}>Deactive</option>
                                                        <option value="reject" {{ (Request::get('status') == 'reject') ? 'selected' : ''}}>Reject</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option @if(Request::get('show') == 15) selected @endif value="15">15</option>
                                                        <option @if(Request::get('show') == 25) selected @endif value="25">25</option>
                                                        <option @if(Request::get('show') == 50) selected @endif value="50">50</option>
                                                        <option @if(Request::get('show') == 100) selected @endif value="100">100</option>
                                                        <option @if(Request::get('show') == 255) selected @endif value="250">250</option>
                                                        <option @if(Request::get('show') == 500) selected @endif value="500">500</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                   
                                                   <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Start_Date</th>
                                                <th>End_Date</th>
                                                <th>Total Poll</th>  
                                                <th>Login_Status</th>                                              
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="homepage_sections">
                                            @foreach($polls as $poll)
                                            <tr id="item{{$poll->id}}">
                                                <td> {{$poll->question_title}}</td>
                                                <td>
                                                    {{Carbon\Carbon::parse($poll->start_date)->format('d M, Y')}}<br/>
                                                    {{Carbon\Carbon::parse($poll->start_date)->format('h:i:s A')}}
                                                </td>
                                                <td>
                                                    {{Carbon\Carbon::parse($poll->end_date)->format('d M, Y')}}<br/>
                                                    {{Carbon\Carbon::parse($poll->end_date)->format('h:i:s A')}}
                                                </td>
                                                <td>0</td>
                                                <td>@if($poll->login_status == 1) <span class="label label-danger"> Required </span> @else  <span class="label label-success"> Not Required </span> @endif</td>
                                                <td>
                                                    <div class="custom-control custom-switch" >
                                                      <input name="status" onclick="satusActiveDeactive('polls', {{$poll->id}})"  type="checkbox" {{($poll->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$poll->id}}">
                                                      <label class="custom-control-label" for="status{{$poll->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            
                                                            <button  class="dropdown-item" type="button" onclick="edit('{{$poll->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                            
                                                            <button  class="dropdown-item" title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.poll.delete", $poll->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                            
                                                        </div>
                                                    </div> 
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->

        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog" style="display: none;">
            <div class="modal-dialog modal-lg">
               
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Poll</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{route('admin.poll.update')}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="card-body"  id="edit_form"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add Modal -->
        <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Poll</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="{{route('admin.poll.store')}}" enctype="multipart/form-data" method="POST" >
                                {{csrf_field()}}
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row" style="padding: 0;margin: 0">
                                        <div class="col-md-8 col-12 divrigth_border">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="required" for="title">Question Title</label>
                                                        <textarea  name="question_title" id="title" value="{{old('question_title')}}" required="" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required">Start Date</label>
                                                        <input type="datetime-local" class="form-control" name="start_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required">End Date</label>
                                                        <input type="datetime-local" class="form-control" name="end_date">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required" for="name">Background Color</label>
                                                        <input type="text" value="#ffffff" name="bg_color"  class="form-control gradient-colorpicker" >
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required" for="name">Text Color</label>
                                                        <input name="text_color" type="text" value="#000000" class="gradient-colorpicker form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="head-label">
                                                        <label class="switch-box" style="margin-left: -12px; top:-12px;">Login Status</label>
                                                        <div  class="status-btn" >
                                                            <div class="custom-control custom-switch">
                                                                <input name="login_status"  type="checkbox" class="custom-control-input" {{ (old('login_status') == 'on') ? 'checked' : '' }} id="login_status">
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
                                                                <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
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
                                                <div class="col-11"> <input type="text" class="form-control"  name="options[]"  placeholder="Enter option"> </div>  <div class="col-1"><button class="btn btn-success" type="button" onclick="pollOption();"><i class="fa fa-plus"></i></button></div>
                                            </div>
                                            <div id="pollOption"></div>
                                            <div class="row justify-content-md-center"><div class="col-md-8"> <span  style="margin-top: 10px; cursor: pointer;" class="btn btn-info btn-sm" onclick="pollOption()"><i class="fa fa-plus"></i> Add More Option </span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete Modal -->
        @include('backend.modal.delete-modal')

@endsection
@section('js')
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
  
    <script type="text/javascript">
        // Colorpicker
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });

        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '{{route("admin.poll.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                    }
                },
                // $ID Error display id name
                @include('common.ajaxError', ['ID' => 'edit_form'])
            });

        }

        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif
    </script>
        <script type="text/javascript">


    var extraOption = 1;
    //add dynamic option fields 
    function pollOption(edit='') {

        extraOption++;
        var objTo = document.getElementById(edit+'pollOption')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", " removeclass" + extraOption);
        var rdiv = 'removeclass' + extraOption;
        divtest.innerHTML = '<div class="form-group row"><div class="col-11 col-md-11"> <input type="text" class="form-control"  name="options[]" placeholder="Enter option"> </div> <div class="col-1 col-md-1"><button class="btn btn-danger" type="button" onclick="remove_pollOption(' + extraOption + ');"><i class="fa fa-times"></i></button></div></div>';

        objTo.appendChild(divtest)
    }
    //remove dynamic extra field
    function remove_pollOption(rid) {
        $('.removeclass' + rid).remove();
    }
    </script>

@endsection
