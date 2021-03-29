@extends('backend.layouts.master')
@section('title', 'Advertisement Update')
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
                    <h4 class="text-themecolor">Update Addvertisement </h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('addvertisement.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Addvertisement List</a>
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
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <form action="{{route('addvertisement.update', $data->id)}}" class="floating-labels" enctype="multipart/form-data" method="post" id="page">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ads_name">Advertisement Name (Optional)</label>
                                            <input type="text" value="{{$data->ads_name}}"  name="ads_name"  id="ads_name" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="adsType">Select Advertisement Type</label>
                                            <select name="adsType"  required="required" id="adsType" class="form-control custom-select">
                                                <option value=""></option>
                                                <option value="google" {{ ($data->adsType =='google') ? 'selected' : '' }}> Google Adsense</option>
                                                <option value="image" {{ ($data->adsType =='image') ? 'selected' : '' }}>Image Ads</option>
                                                <option value="others" {{ ($data->adsType =='others') ? 'selected' : '' }}>Others Ads</option>
                                            </select>
                                        </div>
                                    </div>     

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="page">Select Page</label>
                                            <select name="page"  required="required" id="page" class="form-control custom-select">
                                                <option value=""></option>
                                                <option value="home" {{ ($data->page =='home') ? 'selected' : '' }}> Home page</option>
                                                <option value="category" {{ ($data->page =='category') ? 'selected' : '' }}>Category page</option> 

                                                <option value="search_page" {{ ($data->page =='search_page') ? 'selected' : '' }}>Search page</option>

                                                <option value="details_page" {{ ($data->page =='details_page') ? 'selected' : '' }}>News Details Page</option> 
                                                
                                                <option value="reporter_page" {{ ($data->page =='reporter_page') ? 'selected' : '' }}>Reporter page</option> 
                                                
                                                <option value="user_profile" {{ ($data->page =='user_profile') ? 'selected' : '' }}>User profile Page</option>
                                                
                                                <option value="phato_gallery" {{ ($data->page =='phato_gallery') ? 'selected' : '' }}>Phato gallery</option>
                                                
                                                <option value="video_gallery" {{ ($data->page =='video_gallery') ? 'selected' : '' }}>Video gallery</option>

                                                <option value="custom_page" {{ ($data->page == 'custom_page') ? 'selected' : '' }}>Custom pages</option>
                                            
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="position">Select Position</label>
                                            <select name="position"  required="required" id="position" class="form-control custom-select">
                                                <option value="1" {{ ($data->position ==1) ? 'selected' : '' }}>All Page Right Of Menubar</option>

                                                <option value="2" {{ ($data->position ==2) ? 'selected' : '' }}>Right of the header</option>
                                                
                                                <option value="3" {{ ($data->position ==3) ? 'selected' : '' }}>Top Of the Content</option>
                                                <option value="4" {{ ($data->position ==4) ? 'selected' : '' }}>Middle Of the Content</option>
                                                <option value="5" {{ ($data->position ==5) ? 'selected' : '' }}>Bottom Of the Content</option>
                                                <option value="6" {{ ($data->position ==6) ? 'selected' : '' }}>Sidebar Top </option>
                                               <option value="7" {{ ($data->position ==7) ? 'selected' : '' }}>Sidebar Middle </option>

                                               <option value="8" {{ ($data->position ==8) ? 'selected' : '' }}>Sidebar Bottom </option>
                                              
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="redirect_url">Redirect URL</label>
                                            <input type="text" value="{{$data->redirect_url}}"  name="redirect_url"  id="redirect_url" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="clickBtn">Click Botton Name</label>
                                            <input type="text" value="{{$data->clickBtn}}"   name="clickBtn"  id="clickBtn" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="head-label">
                                            <span class="dropify_image_area">Add Images</span>
                                            <div class="form-group">
                                                <input type="file" data-default-file="{{ asset('upload/ads/'.$data->image) }}"  name="image" id="input-file-now" class="dropify" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="background: #fff;top:-10px;z-index: 1" for="add_code">Add code</label>
                                            <textarea name="add_code" class=" form-control" rows="5" id="add_code" placeholder="Enter text ...">{{$data->add_code}}</textarea>
                                        </div>
                                    </div>
                               
                            
                                    <div class="col-md-12" style="padding: 20px 12px;">
                                        <div class="head-label">
                                            <label class="dropify_image_area" style="top:-12px;">Activation Status</label>
                                            <div  style="padding:0px 1px 30px 40px;">
                                                <div class="custom-control custom-switch">
                                                  <input name="status"  {{ ($data->status == 1) ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="status">
                                                  <label style="padding: 8px 15px;" class="custom-control-label" for="status">Active/DeActive</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update</button>

                                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

@endsection

