@extends('backend.layouts.master')
@section('title', 'Phato gallery list')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

   
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
                    <h4 class="text-themecolor">Phato gallery list</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#add" data-whatever="@mdo"><i
                                class="fa fa-plus-circle"></i> Upload New</button>
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
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Phato</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($get_data as $show_data)
                                        <tr id="item{{$show_data->id}}">
                                            <td>{{$i++}}</td>
                                            <td><img src="{{asset('upload/images/thumb_img/'.$show_data->source_path)}}" width="50" height="50"></td>
                                            <td>{{$show_data->title}}</td>
                                            <td>{{($show_data->status == 1)? 'Active' : 'Deactive'}}</td>
                                            <td>
                                                <button type="button" onclick="edit('{{$show_data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                <button data-target="#delete" onclick="deleteConfirmPopup('{{route("reporter.delete", $show_data->id )}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                   {{$get_data->appends(request()->query())->links()}}
                                  </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $get_data->firstItem() }} to {{ $get_data->lastItem() }} of total {{$get_data->total()}} entries ({{$get_data->lastPage()}} Pages)</div>
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
    <div class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Upload Gallery Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{route('phato.upload')}}" id="imageUploadForm" method="post" class="floating-labels" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="upload-bar">
                                    <p id="message"></p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-image" role="progressbar" aria-valuenow=""
                                             aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            0%
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="upload-file">
                                    <input type="file" class="dropify" required="required"  name="phato" id="input-file-events">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Image Title </label>
                                    <input name="title" type="text" id="title" value="{{old('title')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="dismis" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload Phato</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{route('phato.update')}}" enctype="multipart/form-data"  method="post" class="floating-labels">
            {{ csrf_field() }}
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Phato</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" id="dismis" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

   
        <!-- delete Modal -->
    @include('backend.modal.delete-modal')

@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="{{asset('backend/formjs/jquery.form.js')}}"></script>

    <script>

        $(document).ready(function(){
            $('#imageUploadForm').ajaxForm({
                beforeSend:function(){
                    $('.loader-image').css('display', 'block');
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar-image').text(percentComplete + '%');
                    $('.progress-bar-image').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.progress-bar-image').text('0%');
                        $('.progress-bar-image').css('width', '0%');
                        $('#message').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar-image').text('Upload completed');
                        $('.progress-bar-image').css('width', '100%');
                        $('#message').html('');
                        $('#upload-file').html(data.image);
                        $('#dismis').click();
                        location.reload(true);
                        toastr.success('Image upload successfull');
                       
                    }
                }
            });
        });
    </script>
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
            var  url = '{{route("phato.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $('.dropify').dropify();
                        $("#title").focus();
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
                    }
                }
            });
        }

    
    </script>

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
