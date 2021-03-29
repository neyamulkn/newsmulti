@extends('backend.layouts.master')
@section('title', $reporter->user->name. ' | edit profile' )
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.css">
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <!-- Date picker plugins css -->
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

    <style>

        .page-titles {
            margin: 0 -25px 5px !important;
        }
        .dropify-wrapper{
            margin-bottom: 10px;
        }
        .dropify_image_area{
            position: absolute;top: -14px;left: 12px;background:#fff;padding: 3px;
        }
        .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
        }
        .head-label{
            position:relative;padding: 15px; border: 1px solid #e1e1e1; margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid" style="padding: 0 10px !important;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Update Profile {{$reporter->user->name}}</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('reporter.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Reporter List</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">
                <div class="card-body">
                    <form action="{{route('reporter.update', $reporter->user_id)}}" class="floating-labels" enctype="multipart/form-data" method="post" id="reporter">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="reporter_name">Name</label>
                                        <input type="text" value="{{$reporter->user->name}}"  required="required" name="reporter_name"  id="reporter_name" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" value="{{$reporter->user->phone}}" required="required" name="phone"  id="phone" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="{{$reporter->user->email}}" required name="email"  id="email" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender"  required="required" id="gender" class="form-control custom-select">
                                            <option></option>
                                            <option value="1" {{ ($reporter->user->gender == 1) ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ ($reporter->user->gender ==2) ? 'selected' : '' }}>Female</option>
                                            <option value="4" {{ ($reporter->user->gender ==4) ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="control-label">Birth Date</label>
                                        <input name="birthday" value="{{ $reporter->user->birthday }}"  id="birthdate" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Designation">Designation</label>
                                        <input type="text"  value="{{ $reporter->designation }}" required="required" name="designation"  id="Designation" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Fathers">Fathers Name</label>
                                        <input type="text" value="{{  $reporter->father_name }}"  name="father_name"  id="Fathers" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mothers">Mothers Name</label>
                                        <input type="text"   value="{{  $reporter->mother_name}}" name="mother_name"  id="Mothers" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="Present">Present Address</label>
                                        <textarea name="present_address" value="{{  $reporter->present_address }}" id="Present"  class="form-control"  rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="Permanent">Permanent  Address</label>
                                        <textarea name="permanent_address" value="{{  $reporter->permanent_address }}" id="Permanent"  class="form-control"  rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="role_id">User Roll</label>
                                        <select name="role_id"  required="required" id="role_id" class="form-control custom-select">
                                            <option></option>
                                            
                                            <option value="2" {{ ($reporter->user->role_id ==2) ? 'selected' : '' }}> Senior Reporter</option> 
                                            <option value="4" {{ ($reporter->user->role_id ==4) ? 'selected' : '' }}>General Reporter</option>
                                            <option value="5" {{ ($reporter->user->role_id ==5) ? 'selected' : '' }}>Editor</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datepicker-autoclose" class="control-label">Appointed Date</label>
                                        <input name="appointed_date" value="{{ $reporter->appointed_date }}"  required="required" id="datepicker-autoclose" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national"  class="control-label">National Id</label>
                                        <input name="national_id" value="{{$reporter->national_id }}" id="national" type="number" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="head-label">
                                        <span class="dropify_image_area">Add Images</span>
                                        <div class="form-group">
                                            <input type="file" data-default-file="{{ asset('upload/images/users/thumb_image/'.$reporter->user->image) }}" name="image" id="input-file-now" class="dropify" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <input type="text" value="{{ $reporter->user->username }}" required="required" name="username" autofocus="off" autocomplete="off" id="username" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password"  id="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding: 20px 12px;">
                                    <div class="head-label">
                                        <label class="dropify_image_area" style="top:-12px;">Activation Status</label>
                                        <div  style="padding:0px 1px 13px 40px;">
                                            <div class="custom-control custom-switch">
                                              <input name="status" {{ ($reporter->user->status == 1) ? 'checked' : ''}} type="checkbox" class="custom-control-input" id="status">
                                              <label style="padding: 8px 15px;" class="custom-control-label" for="status">Active/DeActive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><hr>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update</button>

                            <button type="reset" class="btn waves-effect waves-light btn-secondary"> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection

@section('js')


    <script src="{{asset('backend/assets')}}/node_modules/tinymce/tinymce.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/moment/moment.js"></script>

    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Clock Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>


    <script>
        $(document).ready(function() {

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 100,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }
        });


    </script>

    <script>
    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

    $('#min-date').bootstrapMaterialDatePicker({ format: 'DD-MM-YYYY HH:mm', minDate: new Date() });


    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });

    jQuery('#birthdate').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'

    });

    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });

// Enter form submit preventDefault
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });

    </script>
@endsection

