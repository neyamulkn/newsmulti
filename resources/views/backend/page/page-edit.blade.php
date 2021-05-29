@extends('backend.layouts.master')
@section('title', 'Edit page')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets') }}/node_modules/html5-editor/bootstrap-wysihtml5.css">
 
    <link href="{{asset('backend/assets') }}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
  
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
                    <h4 class="text-themecolor">Edit Page </h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('page.list') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Page List</a>
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
                    <form action="{{route('page.update') }}" class="floating-labels" enctype="multipart/form-data" method="post" id="page">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="page_name_bd">Page Name Bangla</label>
                                                <input type="text" value="{{ $data->page_name_bd }}"  required="required" name="page_name_bd"  id="page_name_bd" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="page_name_en">Page Name Enlish</label>
                                                <input type="text" value="{{ $data->page_name_en }}"  required="required" name="page_name_en"  id="page_name_en" class="form-control" >
                                            </div>
                                        </div>
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="mymce">Page Description</label>
                                                <textarea name="page_dsc" class="form-control" id="mymce" rows="5">{{ $data->page_dsc }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="template">Select Template</label>
                                                <select name="template"  required="required" id="template" class="form-control custom-select">
                                                    <option value="1" {{ ( $data->template ==1) ? 'selected' : '' }}>Default Page</option>
                                                    <option value="2" {{ ( $data->template ==2) ? 'selected' : '' }}>All News</option>
                                                     <option value="3" {{ ( $data->template ==3) ? 'selected' : '' }}>Author List</option>
                                                    <option value="4" {{ ( $data->template ==4) ? 'selected' : '' }}>Sitemap</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="menu">Menu</label>
                                                <select name="menu"  required="required" id="menu" class="form-control custom-select">
                                                    <option value="all">All</option>
                                                    <option value="1" {{ ( $data->menu ==1) ? 'selected' : '' }}> Header Top</option>
                                                    <option value="2" {{ ( $data->menu ==2) ? 'selected' : '' }}>Main Menu</option>
                                                    <option value="3" {{ ( $data->menu ==3) ? 'selected' : '' }}>Footer Menu</option>
                                                </select>
                                            </div>
                                        </div>
         
                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <span class="dropify_image_area">Add Images</span>
                                                <div class="form-group">
                                                    <input type="file" data-default-file="{{asset('upload/images/pages/'.$data->images)}}" name="images" id="input-file-now" class="dropify" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="padding: 20px 12px;">
                                            <div class="head-label">
                                                <label class="dropify_image_area" style="top:-12px;">Activation Status</label>
                                                <div  style="padding:0px 1px 30px 40px;">
                                                    <div class="custom-control custom-switch">
                                                      <input name="status"  {{ ( $data->status == 1) ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="status">
                                                      <label style="padding: 8px 15px;" class="custom-control-label" for="status">Active/DeActive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update page</button>

                                <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
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


    <script src="{{asset('backend/assets') }}/node_modules/tinymce/tinymce.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="{{asset('backend/assets') }}/node_modules/moment/moment.js"></script>


    <script src="{{asset('backend/assets') }}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
    </script>


    <script>
        $(document).ready(function() {

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 300,
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



@endsection

