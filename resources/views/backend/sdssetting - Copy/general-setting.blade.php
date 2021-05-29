@extends('backend.layouts.master')
@section('title', 'General Setting')
@section('css')
  <link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />

<link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/css/pages/tab-page.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #generalSetting input, #generalSetting textarea{color: #797878!important}
    .asColorPicker_open{z-index: 9999999;border:1px solid #ccc;}
    .dropify-wrapper{
            width: 300px !important;
            height: 150px !important;
        }
</style>
@endsection
@section('content')
        <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                
                <div class="col-md-12 align-self-center ">
                    <div class="d-fl ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                            <li class="breadcrumb-item active">Setting</li>
                        </ol>
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
               
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title_head">
                                General Setting
                            </div>
                                <h6 class="card-subtitle">Set the basic configuration settings for your site.</h6>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'generalSetting') active @endif" data-toggle="tab" href="#generalSetting" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General Setting</span></a> </li>
                                    
                                    <li class="nav-item"> <a class="nav-link @if(Session::get('updateTab') == 'headerFooter') active @endif" data-toggle="tab" href="#headerFooter" role="tab"><span class="hidden-sm-up"><i class="ti-headphone-alt"></i></span> <span class="hidden-xs-down">Header & Footer Setting</span></a> </li>
                                    
                                    <li class="nav-item"> <a class="nav-link @if(Session::get('updateTab') == 'seoSetting') active @endif" data-toggle="tab" href="#seoSetting" role="tab"><span class="hidden-sm-up"><i class="ti-search"></i></span> <span class="hidden-xs-down"> SEO Setting</span></a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'generalSetting') active @endif " id="generalSetting" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('generalSettingUpdate', $setting->id)}}"  method="post" data-parsley-validate id="generalSetting">
                                                @csrf
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="site_name">Site Name</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="{{$setting->site_name}}" placeholder="Enter site name" name="site_name" required="" id="site_name" class="form-control" >
                                                                </div>

                                                                <label class="col-md-2 text-right col-form-label" for="site_owner">Site Owner Name</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" value="{{$setting->site_owner}}" placeholder="Enter site owner" name="site_owner" id="site_owner" class="form-control" >
                                                                </div>
                                                            </div>
                                                       
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="phone">Phone</label>
                                                                 <div class="col-md-3">
                                                                    <input type="text" value="{{$setting->phone}}" placeholder="Enter phone number" name="phone" required="" id="phone" class="form-control" >
                                                                </div>
                                                            
                                                                <label class="col-md-2 text-right col-form-label required" for="email">Email</label>
                                                                 <div class="col-md-3">
                                                                    <input type="text" value="{{$setting->email}}" placeholder="Enter email number" name="email" required="" id="email" class="form-control" >
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label required" for="date_format ">Date Format</label>
                                                                <div class="col-md-3">
                                                                    <select class="form-control custom-select" name="date_format" id="date_format" required="required">
                                                                        <option value="{{$setting->date_format}}">{{Carbon\Carbon::parse(now())->format($setting->date_format)}}</option>
                                                                         <option value="Y-m-d">{{Carbon\Carbon::parse(now())->format('Y-m-d')}}</option>
                                                                            <option value="d-m-Y">{{Carbon\Carbon::parse(now())->format('d-m-Y')}}</option>
                                                                            <option value="d/m/Y">{{Carbon\Carbon::parse(now())->format('d/m/Y')}} </option>
                                                                            <option value="m/d/Y">{{Carbon\Carbon::parse(now())->format('m/d/Y')}} </option>
                                                                            <option value="m.d.Y">{{Carbon\Carbon::parse(now())->format('m.d.Y')}} </option>
                                                                            <option value="j, n, Y">{{Carbon\Carbon::parse(now())->format('j, n, Y')}} </option>
                                                                            <option value="F j, Y">{{Carbon\Carbon::parse(now())->format('F j, Y')}} </option>
                                                                            <option value="M j, Y" selected="selected">{{Carbon\Carbon::parse(now())->format('M j, Y')}}</option>
                                                                            <option value="j M, Y">{{Carbon\Carbon::parse(now())->format('j M, Y')}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="about">About</label>
                                                                <div class="col-md-8">
                                                                    <textarea rows="2" placeholder="Write about" name="about" class=" form-control" id="about" >{{$setting->about}}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="updateTab" value="generalSetting" class="btn btn-success"> <i class="fa fa-save"></i> Update General Setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane @if(Session::get('updateTab') == 'headerFooter') active @endif  p-20" id="headerFooter" role="tabpanel">
                                        <form action="{{route('generalSettingUpdate', $setting->id)}}"  method="post" data-parsley-validate id="headerFooter">
                                            @csrf
                                            <div class="form-body">
                                                
                                                <div class="">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="header_no">Header No</label>
                                                            <div class="col-md-2">
                                                                <select name="header_no" id="header_no" class="form-control">
                                                                @for($i=1; $i<=10; $i++)
                                                                   <option @if($i == $setting->header_no) selected @endif value="{{$i}}">Header {{$i}}</option>
                                                                @endfor
                                                                </select>
                                                            </div>

                                                            <label class="col-md-1 text-right col-form-label" for="header_no">BG color</label>
                                                            <div class="col-md-2">
                                                                <input name="header_bg_color" value="{{ ($setting->header_bg_color) ? $setting->header_bg_color : '#fff' }}" type="text" value="#fff" class="gradient-colorpicker form-control ">
                                                            </div>

                                                            <label class="col-md-1 text-right col-form-label" for="header_no">Text color</label>
                                                            <div class="col-md-2">
                                                                <input name="header_text_color" value="{{ $setting->header_text_color }}" class="gradient-colorpicker form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="Header">Header Text</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="2" name="header" class=" form-control"  id="Header" placeholder="Enter css, meta tags, script etc">{{$setting->header}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="footer_no">Footer No</label>
                                                             <div class="col-md-2">
                                                                <select  name="footer_no" id="footer_no" class="form-control">
                                                                @for($i=1; $i<=10; $i++)
                                                                   <option @if($i == $setting->footer_no) selected @endif value="{{$i}}">Footer {{$i}}</option>
                                                                @endfor
                                                                </select>
                                                            </div>
                                                            <label class="col-md-1 text-right col-form-label" for="header_no">BG color</label>
                                                            <div class="col-md-2">
                                                                <input name="footer_bg_color" type="text" value="{{($setting->footer_bg_color) ? $setting->footer_bg_color : '#fff' }}" class="gradient-colorpicker form-control ">
                                                            </div>

                                                            <label class="col-md-1 text-right col-form-label" for="header_no">Text color</label>
                                                            <div class="col-md-2">
                                                                <input name="footer_text_color" value="{{ $setting->footer_text_color }}" class="gradient-colorpicker form-control" type="text">
                                                            </div>
                                                        </div>
                                                        


                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="footer">Footer Text</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="2" class="form-control"  name="footer" id="footer" placeholder="Enter js script, etc code">{{$setting->footer}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" style="background: #fff;top:-10px;z-index: 1" for="address">Office Address</label>
                                                            <div class="col-md-8">
                                                                <textarea  rows="2" placeholder="Exm. House, Road, Uttara, Dhaka, Bangladesh" name="address" class=" form-control" id="address" >{{$setting->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="copyright_text">Copyright text</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="copyright_text" value="{{ ($setting->copyright_text) ? $setting->copyright_text : 'Copyright © '. $_SERVER['SERVER_NAME'] .' '.date('Y') }}" class=" form-control" id="copyright_text" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" >Copyright BG color</label>
                                                            <div class="col-md-3">
                                                                <input name="copyright_bg_color" value="{{($setting->copyright_bg_color) ? $setting->copyright_bg_color : '#fff' }}" type="text"  class="gradient-colorpicker form-control ">
                                                            </div>

                                                            <label class="col-md-2 text-right col-form-label">Copyright Text color</label>
                                                            <div class="col-md-3">
                                                                <input name="copyright_text_color" value="{{ $setting->copyright_text_color }}" class="gradient-colorpicker form-control" type="text">
                                                            </div>
                                                        </div>
                                                       
                                                </div><hr>
                                                <div class="form-actions pull-right">
                                                    <button type="submit"  name="updateTab" value="headerFooter" class="btn btn-success"> <i class="fa fa-save"></i> Update Header & Footer Setting</button>
                                                   
                                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane @if(Session::get('updateTab') == 'seoSetting') active @endif p-20" id="seoSetting" role="tabpanel">
                                        <form action="{{route('generalSettingUpdate', $setting->id)}}" enctype="multipart/form-data" method="post" data-parsley-validate id="seoSetting">
                                            @csrf
                                            <div class="form-body">
                                                <div class="">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="title">Meta Title</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$setting->title}}"  name="title" id="title" placeholder = 'Enter meta title'class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="description">Meta Description</label>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control" name="description" id="description" rows="2" style="resize: vertical;" placeholder="Enter Meta Description">{{$setting->description}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label">Meta Keywords</label>
                                                            <div class="col-md-8">
                                                                 <div class="tags-default">
                                                                   
                                                                    <input style="width: 100%" type="text" name="meta_keywords[]"  data-role="tagsinput" value="{{$setting->meta_keywords}}" placeholder="Enter meta keywords" />
                                                                     <p style="font-size: 12px;color: #777;font-weight: initial;">Write meta tags Separated by Comma[,]</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                        
                                                            <label class="col-md-2 text-right col-form-label">Meta image</label>
                                                            <div class="col-md-8">
                                                                <input type="file" data-default-file="{{asset('upload/images/logo/'.$setting->meta_image)}}" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpeg jpg png gif" name="meta_image" id="input-file-events">
                                                            </div>
                                                        </div>
                                                </div><hr>
                                                <div class="form-actions pull-right">
                                                    <button type="submit"  name="updateTab" value="seoSetting" class="btn btn-success"> <i class="fa fa-save"></i> Update Seo Setting</button>
                                                   
                                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
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
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

@endsection

@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
        });
    </script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
    // Enter form submit preventDefault for tags
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });
    </script>


    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    
    <script>
  
   
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
   

    </script>
@endsection