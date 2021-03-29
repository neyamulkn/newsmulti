@extends('backend.layouts.master')
@section('title', 'Add Category')

@section('content')
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
                        <h4 class="text-themecolor">Add Category</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{route('category.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Category List</a>
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
                        <div class="card">

                            <div class="card-body">
                                <form action="{{route('category.store')}}" method="POST" >
                                	{{csrf_field()}}
                                    <div class="form-body">

                                        <!--/row-->
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="bangla">Bangla Category</label>
                                                    <input  name="category_bd" id="bangla" value="{{old('category_bd')}}" required="" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="english">English Category</label>
                                                    <input  name="category_en" id="english" value="{{old('category_en')}}" required="" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-8">
                                                <div class="head-label">
                                                    <label class="switch-box" >Status</label>
                                                    <div  class="status-btn" >
                                                        <div class="custom-control custom-switch">
                                                            <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                            <label class="custom-control-label" for="status">Publish/UnPublish</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                    <button type="button" class="btn btn-inverse">Cancel</button>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

@endsection
