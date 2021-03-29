@extends('backend.layouts.master')
@section('title', 'Genarel Setting')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.css">

    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

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
        textarea {
            resize: vertical !important;
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
                    <h4 class="text-themecolor">Add setting </h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('page.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> setting List</a>
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
                    <form action="{{route('setting.store')}}" class="floating-labels" enctype="multipart/form-data" method="post" id="page">
                        @csrf

                            <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Site Title</label>
                                                <input type="text" value="{{$get_data->title}}"  required="required" name="title"  id="title" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="Header">Header Text Or Code</label>
                                                <textarea name="header_text" class=" form-control" rows="5" id="Header" placeholder="Enter css, meta tags, script etc">{{$get_data->header_text}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="date_format">Date Format</label>
                                              <select class="form-control custom-select" name="date_format" id="date_format" required="required">
                                                    <option value="{{$get_data->date_format}}">{{$get_data->date_format}}</option>
                                                     <option value="Y-m-d">2001-03-15 </option>
                                                        <option value="d-m-Y">15-06-{{'Y'}} </option>
                                                        <option value="d/m/Y">15/06/{{'Y'}} </option>
                                                        <option value="m/d/Y">06/15/{{'Y'}} </option>
                                                        <option value="m.d.Y">06.15.{{'Y'}} </option>
                                                        <option value="j, n, Y">15, 06, {{'Y'}} </option>
                                                        <option value="F j, Y">August 15, {{'Y'}} </option>
                                                        <option value="M j, Y" selected="selected">Aug 13, {{'Y'}} </option>
                                                        <option value="j M, Y">13 Aug, {{'Y'}} </option>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Language">Language</label>
                                                  <select class="form-control custom-select" name="language" id="Language" required="required">
                                                       
                                                        <option value="en"  {{ ($get_data->language == 'en') ? 'selected' : '' }}>English</option>
                                                        <option value="bd" {{ ($get_data->language == 'bd') ? 'selected' : '' }}>Bengali</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <span class="dropify_image_area">Site Logo</span>
                                                <div class="form-group">
                                                    <input type="file" name="logo" id="input-file-now"  data-default-file="{{ asset('backend/images/'. $get_data->logo)}}" class="dropify" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="footer">Footer Text</label>
                                                <textarea class="form-control" rows="3" name="footer" id="footer" placeholder="Enter js script, etc code">{{$get_data->footer}}</textarea>
                                            </div>
                                        </div>
                            </div>


                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>Save</button>

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


      <!-- wysuhtml5 Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();


    });
    </script>
    <!-- Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/moment/moment.js"></script>


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

