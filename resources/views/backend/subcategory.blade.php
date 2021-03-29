@extends('backend.layouts.master')
@section('title', 'Add Sub Category')

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
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add subcategory</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('subcategory.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> subcategory List</a>
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
                            <form action="{{route('subcategory.store')}}" method="POST" class="floating-labels">
                                {{csrf_field()}}
                                <div class="form-body">

                                    <!--/row-->
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="bangla">Bangla SubCategory</label>
                                                <input  name="subcategory_bd" id="bangla" value="{{old('subcategory_bd')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="english">English SubCategory</label>
                                                <input  name="subcategory_en" id="english" value="{{old('subcategory_en')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Category">Category name</label>
                                                <select name="category_id" required id="Category" class="form-control custom-select">
                                                    <option value=""></option>
                                                    @foreach($get_category as $category)
                                                        <option value="{{$category->id}}">{{$category->category_bd}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <div class="head-label">
                                                <label class="switch-box" style="top:-12px;">Status</label>
                                                <div  style="padding:0px 1px 13px 40px" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                        <label style="padding: 8px 15px;" class="custom-control-label" for="status">Publish/UnPublish</label>
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
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
