@extends('backend.layouts.master')
@section('title', 'Reporter list')
@section('css')
    <link href="{{asset('backend/css')}}/pages/bootstrap-switch.css" rel="stylesheet">
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
  
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
                        <h4 class="text-themecolor">Reporter List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('reporter.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i
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
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">

                        <form action="{{route('reporter.list')}}" method="get">

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" value="{{ Request::get('reporter')}}" placeholder="Reporter name or mobile or email" name="reporter" class="form-control">
                                           </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="location" required id="location" style="width:100%" id="location"  class="select2 form-control custom-select">
                                                   <option value="all">All Location</option>
                                                   @foreach($locations as $location)
                                                   <option @if(Request::get('location') == $location->id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
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
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Total_News</th>
                                                <th>Wallet</th>
                                                <th>Designation</th>
                                                <th>Activation</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($reporters as $show_reporter)
                                            <tr id="item{{$show_reporter->id}}">
                                                 <td><img src="{{asset('upload/images/users/thumb_image/'. $show_reporter->photo)}}" width="50" height="50"></td>
                                                
                                                <td>{{$show_reporter->name}}</td>
                                                <td>{{$show_reporter->mobile}}</td>
                                                <td>{{$show_reporter->email}}</td>
                                                <td>{{count($show_reporter->allnews)}}</td>
                                                <td>{{Config::get('siteSetting.currency_symble') . $show_reporter->wallet_balance}}</td>
                                                <td>{{$show_reporter->designation}}</td>
                                                <td>
                                                <div class="bt-switch">
                                                    <input  onchange="approveUnapprove('users', '{{$show_reporter->id}}')" type="checkbox" {{($show_reporter->status == 'active') ? 'checked' : ''}} data-on-color="success" data-off-color="danger" data-on-text="Actived" data-off-text="Deactive"> 
                                                </div>
                                                </td>
                                            
                                                <td>
                                                    @if($show_reporter->status != 'pending')
                                                    <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('users', {{$show_reporter->id}})"  type="checkbox" {{($show_reporter->status == 'active') ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status{{$show_reporter->id}}">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status{{$show_reporter->id}}"></label>
                                                    </div>
                                                    @else
                                                        <span class="label label-warning">Pending </span>
                                                    @endif
                                                </td>

                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                        <a class="dropdown-item" title="View vendor Profile" data-toggle="tooltip" href="{{route('reporter_details', $show_reporter->username)}}"><i class="ti-eye"></i> View Profile</a>

                                                        <a class="dropdown-item" target="_blank" title="Secret login in the seller pannel" data-toggle="tooltip" href="{{route('reporter.secretLogin', encrypt($show_reporter->id))}}"><i class="ti-lock"></i> Secret Login</a>

                                                       <a class="dropdown-item" title="Edit profile" data-toggle="tooltip" href="{{ route('reporter.edit', $show_reporter->id)}}"><i class="ti-pencil-alt"></i> Edit</a>
                                                       
                                                      
                                                        <button class="dropdown-item" data-target="#delete" onclick="deleteConfirmPopup('{{route("reporter.delete", $show_reporter->id )}}')" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                    </div>
                                                </div>                                          
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                           {{$reporters->appends(request()->query())->links()}}
                                          </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $reporters->firstItem() }} to {{ $reporters->lastItem() }} of total {{$reporters->total()}} entries ({{$reporters->lastPage()}} Pages)</div>
                                    </div>
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


    <script type="text/javascript">

      function edit(id){
            var  url = '{{route("reporter.edit", ":id")}}';
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
