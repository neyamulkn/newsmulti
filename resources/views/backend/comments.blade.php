@extends('backend.layouts.master')
@section('title', 'Comment list')
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
                        <h4 class="text-themecolor">Comment List</h4>
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
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="#" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                           
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option @if(Request::get('show') == 15) selected @endif value="15">15</option>
                                                        <option @if(Request::get('show') == 25) selected @endif value="25">25</option>
                                                        <option @if(Request::get('show') == 50) selected @endif value="50">50</option>
                                                        <option @if(Request::get('show') == 100) selected @endif value="100">100</option>
                                                        <option @if(Request::get('show') == 255) selected @endif value="250">250</option>
                                                        <option @if(Request::get('show') == 500) selected @endif value="500">500</option>
                                                        <option @if(Request::get('show') == 750) selected @endif value="750">750</option>
                                                        <option @if(Request::get('show') == 1000) selected @endif value="1000">1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                   
                                                   <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
 
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Comment</th>
                                                <th>News Title</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($get_comments as $show_Comment)
                                           
                                            <tr id="item{{$show_Comment->id}}">
                                                <td>{{$i++}}</td>
                                                <td id="comment{{$show_Comment->id}}"><span>{{Str::limit($show_Comment->comments, 80)}}</span></td>
                                                <td>@if($show_Comment->news)<a href="{{route('news_details', $show_Comment->news_slug)}}"> {{Str::limit($show_Comment->news_title, 50)}}</a>@endif</td>
                                                 <td>{{Carbon\Carbon::parse($show_Comment->created_at)->diffForHumans()}}</td>
                                                <td>{{($show_Comment->type == 1) ? 'On Comment' : 'On Reply'}}</td>
                                                <td>
                                                    <button type="button" onclick="edit('{{$show_Comment->id}}', '{{$show_Comment->comments}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> </button>
                                                    <button type="button" onclick="commentDelete('{{ $show_Comment->id }}' )" class="btn btn-danger btn-sm"> <i class="ti-trash" aria-hidden="true"></i> </button></td>
                                            </tr>
                                           
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                       {{$get_comments->appends(request()->query())->links()}}
                                      </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $get_comments->firstItem() }} to {{ $get_comments->lastItem() }} of total {{$get_comments->total()}} entries ({{$get_comments->lastPage()}} Pages)</div>
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
                <form action="{{route('commentUpdate')}}" id="update_comment"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Comment</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                   
                  </div>
                </form>
            </div>
          </div>
@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
           
        });

    </script>

    <script type="text/javascript">

      function edit(id, comment){
        var fields = '<input type="hidden" name="id" value="'+id+'"> <textarea name="comment" style="resize: vertical;" class="form-control" required >'+comment+'</textarea> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button  type="submit" onclick="formSubmit('+id+')" class="btn btn-sm btn-success">Update</button></div>'
          
        $("#edit_form").html(fields);
          

    }

        //udpate comment
    function formSubmit(id){

        $("#update_comment").submit(function(event){
            event.preventDefault();
          
            $.ajax({
                    url:'{{route("commentUpdate")}}',
                    type:'post',
                    data:$(this).serialize(),
                    success:function(result){
                        $("#comment"+id).html(result);
                        $("#edit").modal("hide");
                        toastr.success('Comment updated');
                       document.getElementById("update_comment").reset();
                    }

            });
        });
    }   

        //comment delete
    function commentDelete(com_id){
        if(confirm("Are you sure delete comment")){
            $.ajax({
                method:'get',
                url:"{{route('commentDelete')}}",
                data:{com_id:com_id},
                success:function(data){
                    
                    if(data.status == 'success'){

                        $('#item'+com_id).hide();
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }else{
            return false;
        }

    }
</script>
@endsection
