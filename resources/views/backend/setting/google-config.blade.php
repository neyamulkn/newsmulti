@extends('backend.layouts.master')
@section('title', 'Google configuration')
@section('css')

<link href="{{asset('backend')}}/css/pages/tab-page.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #generalSetting input, #generalSetting textarea{color: #797878!important}

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
                               	Google Configuration
                            </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'analytics') active @endif" data-toggle="tab" href="#analytics" role="tab"><span class="hidden-sm-up"><i class="ti-stats-up"></i></span> <span class="hidden-xs-down">Google Analytics & Adsense</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link @if(Session::get('updateTab') == 'reCaptcha') active @endif" data-toggle="tab" href="#reCaptcha" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Google reCaptcha</span></a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'analytics') active @endif" id="analytics" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('generalSettingUpdate', config('siteSetting.id'))}}" method="post" data-parsley-validate id="analytics">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="google_analytics">Google analytics</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="5" placeholder="Enter google analytics" name="google_analytics" id="google_analytics" class="form-control" >{!! config('siteSetting.google_analytics') !!}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="google_adsense">Google Adsense</label>
                                                            <div class="col-md-8">
                                                                <textarea rows="5" placeholder="Enter google adsense" name="google_adsense" id="google_adsense" class="form-control">{!! config('siteSetting.google_adsense') !!}</textarea>
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="updateTab" value="analytics" class="btn btn-success"> <i class="fa fa-save"></i> Update Google Setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane @if(Session::get('updateTab') == 'reCaptcha') active @endif" id="reCaptcha" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('generalSettingUpdate', config('siteSetting.id'))}}"  method="post" data-parsley-validate id="reCaptcha">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="recaptcha_site_key">reCaptcha Site Id</label>
                                                            <div class="col-md-6">
                                                                <input type="text" value="{{config('siteSetting.recaptcha_site_key')}}" placeholder="Enter recaptcha site id" name="recaptcha_site_key" id="recaptcha_site_key" class="form-control" >
                                                            </div> 
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 text-right col-form-label" for="recaptcha_secret_key">reCaptcha Secret Key</label>
                                                            <div class="col-md-6">
                                                                <input type="text" value="{{config('siteSetting.recaptcha_secret_key')}}" placeholder="Enter google adsense" name="recaptcha_secret_key" id="recaptcha_secret_key" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-2 text-right col-form-label">
                                                                <label class="col-form-label">Status</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="custom-control custom-switch">
                                                                  <input  name="reCaptcha_login" onclick="satusActiveDeactive('general_settings', '{{config("siteSetting.id")}}', 'reCaptcha_login')"  type="checkbox" {{ (config('siteSetting.reCaptcha_login')) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="reCaptcha_login{{config("siteSetting.id")}}">
                                                                  <label style="padding: 5px 12px" class="custom-control-label" for="reCaptcha_login{{config("siteSetting.id")}}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="updateTab" value="reCaptcha" class="btn btn-success"> <i class="fa fa-save"></i> Update reCaptcha Setting</button>
                                                       
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
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
