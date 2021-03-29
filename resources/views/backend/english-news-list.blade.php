@extends('backend.layouts.master')
@section('title', 'Manage news')
@section('css')
   <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
 
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
                        <h4 class="text-themecolor">Manage English News </h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('englishNews.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i
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
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total News</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-primary"><i class="fa fa-list-ol"></i></span>
                                <a href="{{route('news.list')}}" class="link display-5 ml-auto">{{$all_news}}</a>
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
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending </h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-warning"><i class="fa fa-thumbs-down"></i></span>
                                <a href="{{route('news.list', 'pending')}}" class="link display-5 ml-auto">{{$pending_news}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Draft</h5>
                            <div class="d-flex no-block align-items-center">
                                <span class="display-5 text-danger"><i class="fa fa-battery-empty"></i></span>
                                <a href="{{route('news.list', 'draft')}}" class="link display-5 ml-auto">{{ $draft_news}}</a>
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
                                                        <option value="0" {{ (Request::get('status') == '0') ? 'selected' : ''}} >Pending</option>
                                                        <option value="1" {{ (Request::get('status') == '1') ? 'selected' : ''}}>Active</option>
                                                        <option value="2" {{ (Request::get('status') == '2') ? 'selected' : ''}}>Inactive</option>
                                                        <option value="reject" {{ (Request::get('status') == 'reject') ? 'selected' : ''}}>Reject</option>
                                                        <option value="Sold out" {{ (Request::get('status') == 'Sold out') ? 'selected' : ''}}>Draft</option>
                                                        
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
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Category<br/>Subcategory</th>
                                                <th>Author</th>
                                                <th>Publish Date</th>
                                                <th>Total View</th>
                                               @if(Auth::user()->role_id == env('ADMIN') || Auth::user()->role_id == env('EDITOR'))
                                                <th>Breaking News</th>
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

                                                <td>{{Carbon\Carbon::parse($show_news->publish_date)->diffForHumans()}}</td>
                                                <td>{{$show_news->view_counts}}</td>
                                                @if(Auth::user()->role_id == env('ADMIN') || Auth::user()->role_id == env('EDITOR'))
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="breaking_news" onclick="breaking_news({{$show_news->id}})"  type="checkbox" {{($show_news->breaking_news == 1) ? 'checked' : ''}} class="custom-control-input" id="breaking{{$show_news->id}}">
                                                      <label class="custom-control-label" for="breaking{{$show_news->id}}"></label>
                                                    </div>
                                                </td>
                                                @endif
                                                 @if(Auth::user()->role_id == 1 || Auth::user()->role_id == env('EDITOR') || Auth::user()->role_id == env('REPORTER'))
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('news',{{$show_news->id}})"  type="checkbox" {{($show_news->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$show_news->id}}">
                                                      <label class="custom-control-label" for="status{{$show_news->id}}"></label>
                                                    </div>
                                                </td>
                                                @endif
                                                <td>
                                                    <a  href="{{route('englishNews.edit', $show_news->news_slug)}}"   title="Edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> </a>
                                                    <button data-target="#delete" title="Delete" onclick="deleteConfirmPopup('{{ route('news.delete', $show_news->id)  }}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                     <span style="float: right;">{{$get_news->links()}}</span>
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
@endsection
