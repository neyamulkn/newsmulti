@extends('backend.layouts.master')
@section('title', 'category list')
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
                        <h4 class="text-themecolor">Category List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('category.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Create New</a>
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
                                <i class="drag-drop-info">Drag & drop sorting position</i>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Category Bangla</th>
                                                <th>Category Enlish</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="categories">
                                            <?php $i=1;?>
                                            @foreach($get_category as $show_category)
                                            <tr id="item{{$show_category->id}}">
                                                <td>{{$i++}}</td>
                                                <td>{{$show_category->category_bd}}</td>
                                                <td>{{$show_category->category_en}}</td>
                                                <td>{{($show_category->status == 1)? 'Active' : 'Deactive'}}</td>
                                                <td>
                                                    <button type="button" onclick="edit('{{$show_category->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    <button type="button" onclick="deleteConfirmPopup('{{ route('category.delete', $show_category->id)  }}')" class="btn btn-danger btn-sm"> <i class="ti-trash" aria-hidden="true"></i> Delete</button></td>
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
        <!-- update Modal -->
          <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('category.update')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>


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

    <script type="text/javascript">

      function edit(id){
            var  url = '{{route("category.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                }
            }

        });

    }

</script>
@endsection
