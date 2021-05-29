@extends('backend.layouts.master')
@section('title', 'General Setting')

@section('css')
<link href="{{asset('backend')}}/css/pages/tab-page.css" rel="stylesheet" type="text/css" />
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
                                <div class="title_head"> Social media login configuration</div>
                               
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'facebook_login') active @endif" data-toggle="tab" href="#facebook_login" role="tab"><span class="hidden-sm-up"><i class="ti-facebook"></i></span> <span class="hidden-xs-down">Facebook</span></a> </li>
                                    
                                    <li class="nav-item"> <a class="nav-link @if(Session::get('updateTab') == 'google_login') active @endif" data-toggle="tab" href="#google_login" role="tab"><span class="hidden-sm-up"><i class="ti-google"></i></span> <span class="hidden-xs-down">Google</span></a> </li>
                                    
                                    <li class="nav-item"> <a class="nav-link @if(Session::get('updateTab') == 'twitter_login') active @endif" data-toggle="tab" href="#twitter_login" role="tab"><span class="hidden-sm-up"><i class="ti-twitter"></i></span> <span class="hidden-xs-down"> Twitter</span></a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane @if(!Session::get('updateTab')) active @endif @if(Session::get('updateTab') == 'facebook_login') active @endif " id="facebook_login" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('generalSettingUpdate', config('siteSetting.id'))}}"  method="post" data-parsley-validate id="facebook_login">
                                                @csrf
                                                <div class="form-body">
                                                    
                                                    <div class="">
                                                        <div class="form-group row justify-content-md-center ">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="facebook_client_id">Facebook client id</label>
                                                                <input type="text" value="{{config('siteSetting.facebook_client_id')}}" placeholder="Enter facebook client id" name="facebook_client_id" id="facebook_client_id" class="form-control" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-form-label" for="facebook_client_secret">Facebook client secret</label>
                                                                <input type="text" value="{{config('siteSetting.facebook_client_secret')}}" placeholder="Enter facebook client secret" name="facebook_client_secret" id="facebook_client_secret" class="form-control" >
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="col-form-label">Status</label>
                                                                <div class="custom-control custom-switch">
                                                                  <input  name="facebook_login" onclick="satusActiveDeactive('general_settings', '{{config("siteSetting.id")}}', 'facebook_login')"  type="checkbox" {{ (config('siteSetting.facebook_login')) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="facebook_login{{config("siteSetting.id")}}">
                                                                  <label style="padding: 5px 12px" class="custom-control-label" for="facebook_login{{config("siteSetting.id")}}"></label>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                            
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="updateTab" value="facebook_login" class="btn btn-success"> <i class="fa fa-save"></i> Update Facebook Setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane @if(Session::get('updateTab') == 'google_login') active @endif  p-20" id="google_login" role="tabpanel">
                                        <form action="{{route('generalSettingUpdate', config('siteSetting.id'))}}"  method="post" data-parsley-validate id="google_login">
                                            @csrf
                                            <div class="form-body">
                                                
                                                <div class="">
                                                    <div class="form-group row justify-content-md-center ">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label" for="google_client_id">Google client id</label>
                                                            <input type="text" value="{{config('siteSetting.google_client_id')}}" placeholder="Enter google client id" name="google_client_id" id="google_client_id" class="form-control" >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-form-label" for="google_client_secret">Google client secret</label>
                                                            <input type="text" value="{{config('siteSetting.google_client_secret')}}" placeholder="Enter google client secret" name="google_client_secret" id="google_client_secret" class="form-control" >
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label class="col-form-label">Status</label>
                                                            <div class="custom-control custom-switch">
                                                              <input  name="google_login" onclick="satusActiveDeactive('general_settings', '{{config("siteSetting.id")}}', 'google_login')"  type="checkbox" {{ (config('siteSetting.google_login')) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="google_login{{config("siteSetting.id")}}">
                                                              <label style="padding: 5px 12px" class="custom-control-label" for="google_login{{config("siteSetting.id")}}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                       
                                                </div><hr>
                                                <div class="form-actions pull-right">
                                                    <button type="submit"  name="updateTab" value="google_login" class="btn btn-success"> <i class="fa fa-save"></i> Update google setting</button>
                                                   
                                                    <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane @if(Session::get('updateTab') == 'twitter_login') active @endif p-20" id="twitter_login" role="tabpanel">
                                        <form action="{{route('generalSettingUpdate', config('siteSetting.id'))}}" enctype="multipart/form-data" method="post" data-parsley-validate id="twitter_login">
                                            @csrf
                                            <div class="form-body">
                                                <div class="">
                                                    <div class="form-group row justify-content-md-center ">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label" for="twitter_client_id">Twitter client id</label>
                                                            <input type="text" value="{{config('siteSetting.twitter_client_id')}}" placeholder="Enter twitter client id" name="twitter_client_id" id="twitter_client_id" class="form-control" >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-form-label" for="twitter_client_secret">Twitter client secret</label>
                                                            <input type="text" value="{{config('siteSetting.twitter_client_secret')}}" placeholder="Enter twitter client secret" name="twitter_client_secret" id="twitter_client_secret" class="form-control" >
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="col-form-label">Status</label>
                                                            <div class="custom-control custom-switch">
                                                              <input  name="twitter_login" onclick="satusActiveDeactive('general_settings', '{{config("siteSetting.id")}}', 'twitter_login')"  type="checkbox" {{ (config('siteSetting.twitter_login')) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="twitter_login{{config("siteSetting.id")}}">
                                                              <label style="padding: 5px 12px" class="custom-control-label" for="twitter_login{{config("siteSetting.id")}}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><hr>
                                                <div class="form-actions pull-right">
                                                    <button type="submit"  name="updateTab" value="twitter_login" class="btn btn-success"> <i class="fa fa-save"></i> Update Twitter Setting</button>
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
