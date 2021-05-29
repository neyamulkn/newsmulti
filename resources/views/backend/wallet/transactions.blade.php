@extends('backend.layouts.master')
@section('title', 'Transactions History')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        #Wallet_recharge p{padding:0; margin: 0;}
        #Wallet_recharge label{margin: 5px 0 ;}
    </style>

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
                        <h4 class="text-themecolor">Transactions History</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <button data-toggle="modal" data-target="#Wallet_recharge" class="btn btn-info d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Wallet Recharge</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
             
                <div class="row">
                    
                    <!-- Column -->
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Balance</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-purple"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{Config::get('siteSetting.currency_symble'). $totalBalance}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total withdraw</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{Config::get('siteSetting.currency_symble'). $totalWithdraw}}</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Available Wallet</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{Config::get('siteSetting.currency_symble'). ($totalBalance - $totalWithdraw)}}</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="card" data-toggle="modal" data-target="#Wallet_recharge">
                        <div class="card-body " style="text-align: center;cursor: pointer;">
                            
                            <div class="align-items-center">
                                <span class="display-5 text-warning"><i class="fa fa-plus-circle"></i></span>
                            </div>
                            <h5 class="card-title">Wallet Recharge</h5>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="row">
                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <div class="table-responsive">
                                       <table id="config-table" class="table display table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Payment Info</th>
                                                    <th>Notes</th>
                                                    <th>Added By</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if(count($allWallets)>0)
                                                @foreach($allWallets as $index => $wallet)
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                   <td>
                                                    @if($wallet->user)<a title="View user Profile" data-toggle="tooltip" href="{{ route('reporter.profile', $wallet->user->username) }}">{{$wallet->user->name }} </a><br/>@endif
                                                    {{\Carbon\Carbon::parse($wallet->created_at)->format(Config::get('siteSetting.date_format'))}}
                                                   ({{\Carbon\Carbon::parse($wallet->created_at)->diffForHumans()}})
                                                   </td>
                                                   <td>{{ $wallet->type }}</td>
                                                    
                                                    <td>
                                                     @if($wallet->amount<0 || $wallet->type == 'withdraw')  <span class="label label-danger">
                                                      - {{Config::get('siteSetting.currency_symble').  str_replace('-', '', $wallet->amount) }}</span>
                                                    @else
                                                    <span class="label label-info">
                                                       {{Config::get('siteSetting.currency_symble'). str_replace('+', '', $wallet->amount) }}</span>
                                                    @endif
                                                    </td>
                                                    
                                                     <td>@if($wallet->paymentGateway){{$wallet->paymentGateway->method_name}} 
                                                    <br/>
                                                    @else
                                                    {{$wallet->payment_method}}
                                                     <br/>
                                                    @endif
                                                   
                                                    @if($wallet->transaction_details){{$wallet->transaction_details}} @endif
                                                    </td>
                                                     <td>{{ $wallet->notes }}</td>
                                                     <td> {{ ($wallet->addedBy) ? $wallet->addedBy->name : 'user' }}</td>
                                                   
                                                    <td>@if($wallet->status == 'paid') <span class="label label-success"> {{$wallet->status}}</span> @elseif($wallet->status == 'cancel') <span class="label label-danger"> {{$wallet->status}} </span> @else <span class="label label-info"> {{$wallet->status}} </span> @endif</td>
                                                </tr>
                                               @endforeach
                                            @else <tr><td colspan="8"> <h1>No Wallet found.</h1></td></tr>@endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="row">
                   <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       {{$allWallets->appends(request()->query())->links()}}
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $allWallets->firstItem() }} to {{ $allWallets->lastItem() }} of total {{$allWallets->total()}} entries ({{$allWallets->lastPage()}} Pages)</div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
    <!-- add Modal -->
        <div class="modal fade" id="Wallet_recharge" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Wallet Recharge</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('walletRecharge')}}" data-parsley-validate method="POST" >
                                {{csrf_field()}}
                                <div class="form-body">
                                    <div class="row">
                                        
                                        <div class="col-md-8 col-10">
                                            <input value="{{old('user')}}" type="text" id="user" class="form-control" name="user" placeholder="user name or mobile or email">
                                            <span style="color: red" id="error"></span>
                                        </div>
                                        <div class="col-md-4 col-2">
                                            <div><button style="padding: 6px;" type="button" id="getuserDetails" class="btn btn-info"><i class="fa fa-search"></i> <span class="hidden-md-down"> Find user</span></button></div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div id="showuserDetails"> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

       
    @endsection

    @section('js')
    <script type="text/javascript">
        // get user Details by search
       $('#getuserDetails').on('click', function(){
            var user = $('#user').val();

            $("#error").html('');
            if(user != ''){
              
                $('#showuserDetails').html('<div class="loadingData"></div>');
                var  url = '{{route("getWalletInfo")}}';
                
                $.ajax({
                    url:url,
                    method:"get",
                    data:{user:user},
                    success:function(data){
                        
                        if(data){
                            $("#showuserDetails").html(data);
                           
                        }else{
                            $("#showuserDetails").html('<div style="color:red">user not found.</div>');
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Internal server error.');
                        $("#showuserDetails").html('<div style="color:red">user not found.</div>');
                }
                });
            }else{
                $("#error").html('This field is required');
                 $("#showuserDetails").html('');
            }
        });
    </script>
    @endsection
 
