@extends('reporter.layouts.master')
@section('title', 'Transactions History')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        #withdraw_request p{padding:0; margin: 0;}
        #withdraw_request label{margin: 5px 0 ;}
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

                            <button data-toggle="modal" data-target="#withdraw_request" class="btn btn-info d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Wallet Withdraw Request</button>
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
                            <h5 class="card-title">Current Balance</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-purple"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{ config('siteSetting.currency_symble') . Auth::guard('reporter')->user()->wallet_balance}}</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending withdrawal</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-info"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{config('siteSetting.currency_symble') . $wallets->where('type', 'withdraw')->whereIn('status', ['pending','accepted'])->sum('amount')}}</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total withdraw</h5>
                            <div class="d-flex  no-block align-items-center">
                                <span class="display-5 text-success"><i class="fa fa-donate"></i></span>
                                <a href="javscript:void(0)" class="link display-5 ml-auto">{{config('siteSetting.currency_symble') . $wallets->where('type', 'withdraw')->where('status', 'paid')->sum('amount')}}</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-3">
                    <div class="card" data-toggle="modal" data-target="#withdraw_request">
                        <div class="card-body " style="text-align: center;cursor: pointer;">
                            
                            <div class="align-items-center">
                                <span class="display-5 text-warning"><i class="fa fa-reply-all"></i></span>
                            </div>
                            <h5 class="card-title">Send Withdraw Request</h5>
                        </div>
                    </div>
                    </div>
                </div>

                @if(Session::has('success'))
                <div class="alert alert-success">
                  <strong>Success! </strong> {{Session::get('success')}}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  <strong>Error! </strong> {{Session::get('error')}}
                </div>
                @endif
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

                                            @if(count($wallets)>0)
                                                @foreach($wallets as $index => $wallet)
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
                       {{$wallets->appends(request()->query())->links()}}
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $wallets->firstItem() }} to {{ $wallets->lastItem() }} of total {{$wallets->total()}} entries ({{$wallets->lastPage()}} Pages)</div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
    <!-- add Modal -->
        <div class="modal fade" id="withdraw_request" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Wallet Withdraw Request</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                        @if(Auth::user()->wallet_balance >= $withdraw_configure->value2)
                        <form action="{{route('reporter.withdrawRequest')}}" method="POST" data-parsley-validate>
                            {{csrf_field()}}
                            <div class="form-body">
                               
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="method_name">Withdraw Amount</label>
                                            <input required="" name="amount" min="{{$withdraw_configure->value2}}" id="amount" value="{{old('amount')}}" type="number" placeholder="Example {{Config::get('siteSetting.currency_symble'). $withdraw_configure->value2}}" class="form-control">
                                             <i style="color: red">Minimun withdraw amount {{Config::get('siteSetting.currency_symble'). $withdraw_configure->value2}}</i>
                                            @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                                {{ $errors->first('amount') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="payment_method">Withdrawal Method</label>
                                            <select id="payment_method" name="payment_method" required="" class="form-control select2 m-b-10" style="width: 100%" >
                                                <option value="">Select Withdrawal Method</option>
                                             @foreach($paymentGateways as $paymentgateway)
                                                <option @if(old('payment_method') == $paymentgateway->id) selected @endif value="{{$paymentgateway->id}}">{{$paymentgateway->method_name}}</option>
                                                @endforeach
                                            </select>
                                             @if ($errors->has('payment_method'))
                                            <span class="invalid-feedback" role="alert">
                                                {{ $errors->first('payment_method') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="AccountNumber">
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="details">Notes</label>
                                            <textarea rows="1" name="notes" id="notes"  style="resize: vertical;" placeholder="Write your notes" class="form-control">{{old('notes')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="password">Password</label>
                                            <input type="password" required name="password" id="password"  placeholder="Enter password" autocomplete="false" class="form-control">
                                             @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                {{ $errors->first('password') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="submit" name="submitType" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Send Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <p style="color: red">Insufficent your wallet balance</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

       
    @endsection

    @section('js')
    <script type="text/javascript">
        $("#payment_method").change(function(){
            var account_no = '';
            if(this.value){
                var method_name = $("#payment_method option:selected").text();
                account_no =  `<div class="form-group">
                    <label class="required" for="account_no">`+ method_name+` account number</label>
                    <input type="text" value="{{old('account_no')}}" required name="account_no" id="account_no"  placeholder="Enter account number" class="form-control">
                     @if ($errors->has('account_no'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('account_no') }}
                    </span>
                    @endif
                </div>`;
            }
            document.getElementById('AccountNumber').innerHTML = account_no;
        });
    </script>
    @endsection
 
