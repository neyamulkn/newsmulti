@extends('backend.layouts.master')
@section('title', 'page list')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

@endsection
@section('content')
        <!-- Page wrapper  -->
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
                        <h4 class="text-themecolor">page List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('page.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Bangla Name</th>
                                                <th>English Name</th>
                                                <th>Template</th>
                                                <th>Page Link</th>
                                                <th>Display In</th>
                                                <th>Is Default</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pages as $data)
                                            <tr id="item{{$data->id}}">

                                                <td>{{$data->page_name_bd}}</td>
                                                <td>{{$data->page_name_en}}</td>
                                                <td>
                                                    @if($data->template == 1) Default Page
                                                    @elseif($data->template == 2) All News
                                                    @elseif($data->template == 3) Author List
                                                    @else
                                                        Sitemap
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url(($data->page_slug == 'homepage') ? '/' :  $data->page_slug)}}" target="_blank">Copy Link <i class="fas fa-external-link-alt"></i> </a>
                                                </td>
                                                <td>
                                                    @if($data->menu == 1) Header Top
                                                    @elseif($data->menu == 2) Main Menu
                                                    @elseif($data->menu == 3) Footer Menu
                                                    @else
                                                        Not Set
                                                    @endif
                                                </td>
                                                <td>@if($data->is_default ==1)<span class="label label-warning">Default</span>@else<span class="label label-info">Custom</span>@endif</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                      <input name="status"  onclick="satusActiveDeactive('pages', {{$data->id}})" type="checkbox" class="custom-control-input" {{($data->status == 1) ? 'checked' : ''}} id="{{$data->id}}">
                                                      <label class="custom-control-label" for="{{$data->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('page.edit', $data->page_slug) }}" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</a>
                                                     @if($data->is_default !=1)
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('{{ route("page.delete", $data->id )}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
   
        <!-- delete Modal -->
        @include('backend.modal.delete-modal')

@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });


        });

    </script>


@endsection
