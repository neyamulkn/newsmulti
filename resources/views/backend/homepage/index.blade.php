@extends('backend.layouts.master')
@section('title', 'Homepage section list')

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
                        <h4 class="text-themecolor">Homepage section List</h4>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <i class="drag-drop-info">Drag & drop sorting position</i>
                                
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Section Title</th>
                                              
                                                <th>Section layout</th>
                                                <th>Item Number</th>
                                                <th>Section Width</th>
                                                <th>Devices Display</th>
                                                <th>Is Default</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="homepage_sections">
                                            @foreach($homepageSections as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>
                                                    <img src="{{ asset('upload/images/homepage/'.$data->thumb_image) }} " width="40" alt="">
                                                    {{$data->title}}
                                                    @if($data->sub_title)
                                                    <p>{{$data->sub_title}}</p>@endif
                                                </td>
                                                
                                              
                                                <td>@if($data->is_default) <span class="label label-danger"> Default </span> @else {{str_replace('_', ' ', $data->section_layout)}} @endif</td>
                                                
                                                <td>{{ $data->item_number }}</td>
                                                <td><span class="label label-info"> {{($data->layout_width == 'full') ? 'Full' : 'Box'}}</span>
                                                </td>
                                                <td>
                                                    Desktop: {{ $data->section_box_desktop }}<br/>
                                                    Mobile: {{ $data->section_box_mobile }}
                                                </td>
                                                <td>{!!($data->is_default == 1) ? '<span class="label label-info"> Default</span>' : '<span class="label label-danger">Custom</span>' !!}
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch" >
                                                      <input name="status" onclick="satusActiveDeactive('homepage_sections', {{$data->id}})"  type="checkbox" {{($data->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$data->id}}">
                                                      <label class="custom-control-label" for="status{{$data->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class=" dropdown-menu">
                                                            @if($data->is_default != 1)
                                                            <a title="Add item under this section"  class="btn btn-primary btn-sm" href="{{route('admin.homepageSectionItem', $data->slug)}}"><i class="ti-pin-alt" aria-hidden="true"></i> Manage {{$data->section_type}}</a>
                                                            @endif
                                                            <button  class="dropdown-item" type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                            @if($data->is_default != 1)
                                                            <button  class="dropdown-item" title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.homepageSection.delete", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                            @endif
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
                <form action="{{route('admin.homepageSection.update')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update homepage section</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <!-- add Modal -->
        <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Homepage section</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('admin.homepageSection.store')}}" enctype="multipart/form-data" method="POST" >
                                {{csrf_field()}}
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">Section Title</label>
                                                <input  name="title" id="name" value="{{old('title')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_title">Sub Title</label>
                                                <input name="sub_title" id="sub_title" value="{{old('sub_title')}}"  type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name required">Section Sourch</label>
                                                <select required name="section_type"  onchange="sectionType(this.value)" class="form-control">
                                                    <option value="">Select Sourch</option>
                                                    <option value="news">Pick newses</option>
                                                    <option value="category">Category</option>
                                                    <option value="ads">Ads</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="showSection"></div>

                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Number Of Item</label>
                                                <input type="number" class="form-control" placeholder="Example: 7" name="item_number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Box Desktop</label>
                                                <input type="number" class="form-control" placeholder="Example: 5" name="section_box_desktop">
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Box Mobile</label>
                                                <input type="number" class="form-control" placeholder="Example: 3" name="section_box_mobile">
                                            </div>
                                        </div> 

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Section Width</label>
                                                <select name="layout_width" class="form-control">
                                                    <option value="">Select Width</option>
                                                    <option value="box">Boxed width</option>
                                                    <option value="full">Full width</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="name">Bacground Color</label>
                                                <input type="text" name="background_color" value="transparent" class="form-control gradient-colorpicker" >
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="name">Text Color</label>
                                                <input name="text_color" value="#000000" class="gradient-colorpicker form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Backround Image</label>
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="background_image" id="input-file-events">
                                                <i class="info">Recommended size: 1250px*300px</i>
                                            </div>
                                            @if ($errors->has('background_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('background_image') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Tumbnail Image</label>
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
                                                <i class="info">Recommended size: 300px*250px</i>
                                            </div>
                                            @if ($errors->has('thumb_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('thumb_image') }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Image Position</label>
                                                <select name="image_position" class="form-control">
                                                    <option value="left">Left</option>
                                                    <option value="center">Center</option>
                                                    <option value="right">Right</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <label class="switch-box" style="margin-left: -12px; top:-12px;">Status</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
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

    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script>

    // Colorpicker
  
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $(".select2").select2();
    </script>

    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
       
    });
    </script>
    <script type="text/javascript">

    function sectionType(sectionType, edit=''){

        var output = '';
        if(sectionType == 'category'){
            output = '<div class="form-group"> <label for="name required">Section Layout</label> <select required name="section_layout" class="form-control"><option value="">Select Layout</option>  @for($i=1; $i<=6; $i++) <option value="layout-{{$i}}">Layout {{$i}}</option> @endfor </select> </div>';
        }else{
            output = '';
        }
        if(edit == 'edit'){
            $('#editshowSection').html(output);
            $('#showSection').html('');
        }else{
            $('#showSection').html(output);
            $('#editshowSection').html('');
        }
        
       
    }

        function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '{{route("admin.homepageSection.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $(".select2").select2();
                        $('.dropify').dropify();
                        $(".gradient-colorpicker").asColorPicker({
                            mode: 'gradient'
                        });
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

@endsection
