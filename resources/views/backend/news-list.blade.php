@extends('backend.layouts.master')
@section('title', 'Manage news')
@section('css')
   <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <link href="{{asset('backend/css')}}/pages/bootstrap-switch.css" rel="stylesheet">

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
                        <h4 class="text-themecolor">Total News <a title="All news" href="{{route('news.list')}}">({{$all_news}})</a></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('news.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending News</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-primary"><i class="fa fa-list-ol"></i></span>
                                <a href="{{route('news.list', 'pending')}}" class="link display-5 ml-auto">{{$pending_news}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Deactive </h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-warning"><i class="fa fa-thumbs-down"></i></span>
                                <a href="{{route('news.list', 'deactive')}}" class="link display-5 ml-auto">{{$deactive_news}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Active </h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-thumbs-up"></i></span>
                                <a href="{{route('news.list' , 'active')}}" class="link display-5 ml-auto">{{$active_news}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reject</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-times"></i></span>
                                <a href="{{route('news.list', 'reject')}}" class="link display-5 ml-auto">{{ $reject_news}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Image Missing</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-bug"></i></span>
                                <a href="{{route('news.list','image-missing')}}" class="link display-5 ml-auto">{{$image_missing}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Breaking</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-bolt"></i></span>
                                <a href="{{route('news.list','breaking')}}" class="link display-5 ml-auto">{{$breaking}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="#" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="seller" required id="seller" style="width:100%" id="seller"  class="select2 form-control custom-select">
                                                       <option value="all">Repoter All</option>
                                                       @foreach($reporters as $repoter)
                                                       <option value="{{$repoter->id}}">{{$repoter->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select name="category" required id="category" style="width:100%" id="category"  class="select2 form-control custom-select">
                                                       <option value="all">All category</option>
                                                       @foreach($categories as $category)
                                                       <option value="{{$category->id}}">{{$category->category_bd}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="deactive" {{ (Request::get('status') == 'deactive') ? 'selected' : ''}}>Deactive</option>
                                                        <option value="reject" {{ (Request::get('status') == 'reject') ? 'selected' : ''}}>Reject</option>
                                                    </select>
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
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Categories</th>
                                                <th>Author</th>
                                                <th>Publish_Date</th>
                                                <th>Views</th>
                                                 @if(Auth::user()->role_id == env('ADMIN') || Auth::user()->role_id == env('EDITOR'))
                                                <th>Breaking</th>
                                                <th>Published</th>
                                                @endif
                                                 @if(Auth::user()->role_id == 1 || Auth::user()->role_id == env('EDITOR') || Auth::user()->role_id == env('REPORTER'))
                                                <th>Status</th>
                                                @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($get_news as $show_news)
                                            <tr id="item{{$show_news->id}}">
                                               <td><img src="{{asset('upload/images/thumb_img/'.$show_news->source_path)}}" width="100"></td>
                                                <td><a href="{{route('news_details', $show_news->news_slug)}}" target="_blank">{{Str::limit($show_news->news_title, 20)}}</a> </td>
                                                <td>{{$show_news->category_bd}} <br/>
                                                    {{$show_news->subcategory_bd}}
                                                </td>
                                                <td><a href="{{route('reporter_details', $show_news->username)}}" target="_blank">{{$show_news->name}}</a></td>

                                                <td>
                                                    {{Carbon\Carbon::parse($show_news->publish_date)->format('d M, Y')}}<br/>
                                                    {{Carbon\Carbon::parse($show_news->publish_date)->format('h:i:s A')}}
                                                </td>
                                                <td> {{$show_news->view_counts}}</td>
                                                @if(Auth::user()->role_id == env('ADMIN') || Auth::user()->role_id == env('EDITOR'))
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="breaking_news" onclick="breaking_news({{$show_news->id}})"  type="checkbox" {{($show_news->breaking_news == 1) ? 'checked' : ''}} class="custom-control-input" id="breaking{{$show_news->id}}">
                                                      <label class="custom-control-label" for="breaking{{$show_news->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="bt-switch" title="News current status {{$show_news->status}}">
                                                        <input onchange="approveUnapprove('news', '{{$show_news->id}}')" type="checkbox" {{($show_news->status != 'pending') ? 'checked' : ''}} data-on-color="success" data-off-color="danger" data-on-text="Published" data-off-text="Unpublish"> 
                                                   
                                                    </div>
                                                </td>
                                                @endif
                                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == env('EDITOR') || Auth::user()->role_id == env('REPORTER'))
                                                <td>
                                                    @if($show_news->status == 'active' || $show_news->status == 'deactive')
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('news',{{$show_news->id}})"  type="checkbox" {{($show_news->status == 'active') ? 'checked' : ''}} class="custom-control-input" id="status{{$show_news->id}}">
                                                      <label class="custom-control-label" for="status{{$show_news->id}}"></label>
                                                    </div>
                                                    @else
                                                        <span class="label label-danger"> {{$show_news->status}} </span>
                                                    @endif
                                                </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a target="_blank" class="dropdown-item text-inverse" title="View news" data-toggle="tooltip" href="{{ route('news_details', $show_news->news_slug) }}"><i class="ti-eye"></i> View News</a>
                                                            <a  href="{{route('news.edit', $show_news->news_slug)}}"   title="Edit" class="dropdown-item"><i class="ti-pencil" aria-hidden="true"></i> Edit</a>
                                                   
                                                            <button data-target="#delete" title="Delete" onclick="deleteConfirmPopup('{{ route('news.delete', $show_news->id)  }}')" class="dropdown-item" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                        </div>
                                                    </div> 
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>

                                <div class="row">
                                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                       {{$get_news->appends(request()->query())->links()}}
                                      </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $get_news->firstItem() }} to {{ $get_news->lastItem() }} of total {{$get_news->total()}} entries ({{$get_news->lastPage()}} Pages)</div>
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
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
   
    <!-- end - This is for export functionality only -->
    <script>

        $(".select2").select2();
     

    </script>

    <script type="text/javascript">

        function satusActiveDeactive(id){

            var  url = '{{route("news.status", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data.status == 'publish'){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }
        function breaking_news(id){

            var  url = '{{route("breaking_news", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data.status == 'added'){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }
</script>

        <!-- bt-switch -->
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
@endsection
