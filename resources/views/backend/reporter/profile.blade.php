@extends('backend.layouts.master')
@section('title', $reporter->name.' | Profile')

@section('content')

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
                    <h4 class="text-themecolor">Profile</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reporter</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                        <a href="{{route('reporter.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-angle-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-3 col-xlg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <center> <img src="{{asset('upload/images/users/thumb_image/'.$reporter->photo)}}" class="img-circle" width="150" />
                                <h4 class="card-title m-t-10">{{$reporter->name}}</h4>
                                <h6 class="card-subtitle">{{$reporter->shop_dsc}}</h6>
                                <div class="row text-center justify-content-md-center">
                                    <div class="col-6"><a title="User status" href="javascript:void(0)" class="link"><i class="fa fa-check"></i> <font class="font-medium">{{($reporter->status == 'active') ? 'Active' : 'Deactive'}} </font></a></div>
                                    <div class="col-6"><a title="Total Tickets " href="javascript:void(0)" class="link"><i class="fa fa-clipboard-list"></i> <font class="font-medium">{{Config::get('siteSetting.currency_symble'). $reporter->wallet_balance}}</font></a></div>
                                </div>
                            </center>
                            <hr/>
                            <small class="text-muted">Mobile</small>
                            <h6>{{$reporter->mobile}}</h6> 
                            <small class="text-muted">Email</small>
                            <h6>{{$reporter->email}}</h6> 

                            <small class="text-muted">Member Since </small>
                            <h6>{{Carbon\Carbon::parse($reporter->created_at)->format(Config::get('siteSetting.date_format'))}}</h6> 
                            <small class="text-muted p-t-30 db">Birthday</small>
                            <h6>{{ Carbon\Carbon::parse($reporter->birthday)->format(Config::get('siteSetting.date_format'))}}</h6> 
                            <p> @if($reporter->gender) Gender: {{ $reporter->gender }} @endif 
                                @if($reporter->blood)  Blood: {{ $reporter->blood }} @endif
                            </p>
                            <small class="text-muted p-t-30 db">Address</small>
                            
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-9 col-xlg-9 col-md-9">
                    <div class="card">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                        
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#News" role="tab"><i class="fa fa-pen-square"></i> News</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#orders" role="tab"><i class="fa fa-chart-line"></i> Transactions</a> </li>
                           <!--  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"> <i class="fa fa-chart-line"></i> Reports</a> </li> -->
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="News" role="tabpanel">
                                <div class="card-body">
                                    <label class="title_head">
                                        News
                                    </label>
                                    <div class="row">
                                        
                                        <div class="col-md-12 col-xs-6 b-r">
                                            <div class="table-responsive">
                                               <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Categories</th>
                                                            <th>Publish_Date</th>
                                                            <th>Views</th>
                                                            
                                                            <th>Status</th>
                                                           
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
                                                            

                                                            <td>
                                                                {{Carbon\Carbon::parse($show_news->publish_date)->format('d M, Y')}}<br/>
                                                                {{Carbon\Carbon::parse($show_news->publish_date)->format('h:i:s A')}}
                                                            </td>
                                                            <td> {{$show_news->view_counts}}</td>
                                                           
                                                            <td>
                                                                @if($show_news->status == 'active') <span class="label label-success"> {{$show_news->status}} </span>
                                                                @else
                                                                <span class="label label-info">{{$show_news->status}} </span>
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
                            </div>
                            <div class="tab-pane" id="orders" role="tabpanel">
                                <div class="card-body">
                                    <label class="title_head">
                                        Transaction list
                                    </label>
                                    <div class="row">
                   
                                        <div class="col-lg-12">
                                           
                                            <div class="table-responsive">
                                                
                                                <div class="table-responsive">
                                                   <table  class="table display table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Type</th>
                                                                <th>Amount</th>
                                                                <th>Payment Info</th>
                                                                <th>Notes</th>
                                                                <th>Added By</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        @if(count($transactions)>0)
                                                            @foreach($transactions as $index => $wallet)
                                                            <tr>
                                                                <td>{{ $index+1 }}</td>
                                                               <td>
                                                                
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
                                        <!-- Column -->
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                           {{$transactions->appends(request()->query())->links()}}
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of total {{$transactions->total()}} entries ({{$transactions->lastPage()}} Pages)</div>
                                    </div>
                                        
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- Row -->
            <!-- ============================================================== -->
            <!-- End PAge Content -->
          
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
@endsection


