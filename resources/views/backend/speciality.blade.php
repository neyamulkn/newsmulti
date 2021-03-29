@extends('backend.layouts.master')
@section('title', 'Add speciality')

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
                        <h4 class="text-themecolor">Add speciality</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('speciality.list') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-eye"></i> speciality List</a>
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
                                <form action="{{route('speciality.store')}}" method="POST" class="floating-labels">
                                	{{csrf_field()}}
                                    <div class="form-body">

                                        <!--/row-->
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input name="speciality_name" value="{{old('speciality_name')}}" required="" type="text" class="form-control">
                                                    <span class="bar"></span>
                                                    <label>Speciality name</label>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" required="" class="form-control custom-select">   <option></option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Deactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                            </div>
                                            <!--/span-->
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

