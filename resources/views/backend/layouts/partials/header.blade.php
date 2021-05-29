<header class="topbar" style="background:{{ config('siteSetting.header_bg_color') }}; color: {{ config('siteSetting.header_text_color')}}"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a target="_blank" class="navbar-brand" href="{{route('home')}}">
               
            <b><img  src="{{ asset('upload/images/logo/'.config('siteSetting.favicon'))}}" alt="homepage" class="light-logo" />
            </b><span>
             <!-- Light Logo text -->    
             <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" width="150" class="light-logo" alt="homepage" /></span> 
            <!--End Logo icon -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
         
                <!-- Messages -->
                <!-- ============================================================== -->
                <?php $notifications = App\Models\Notification::where('toUser', Auth::id())->orderBy('id', 'desc')->get(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-bell"></i>
                        @if(count($notifications->where('read', 0))>0)
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        @endif
                    </a>
                    @if(count($notifications)>0)
                    <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                        <ul>
                            
                            <li>
                                <div class="message-center">
                                     @foreach($notifications->take(7) as $notification)

                                        @if($notification->type == env('NEWS'))
                                        @if($notification->news)
                                            <a onclick="readNotify('{{$notification->id}}')" @if($notification->news->status == 1) href="{{route('news.list')}}" @elseif($notification->news->status == 2) href="{{route('news.list', 2)}}" @else  href="{{route('news.list', 0)}}" @endif>
                                                <div class="user-img"> <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->photo)}}" alt="user" class="img-circle"></div>
                                                <div class="mail-contnet">
                                                    <h5>{{$notification->user->username}}</h5> <span class="mail-desc"><strong>{{$notification->notify}} </strong> - {{Str::limit($notification->news->news_title, 20)}}</span> <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                                </div>
                                            </a>
                                        @endif
                                        @endif

                                        @if($notification->type == env('COMMENT'))
                                           @if($notification->comment && $notification->comment->news)
                                            <a onclick="readNotify('{{$notification->id}}')"  href="{{route('comments',$notification->comment->news->news_slug)}}#singleComment{{$notification->item_id}}">
                                                <div class="user-img"> <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->photo)}}" alt="user" class="img-circle"></div>
                                                <div class="mail-contnet">
                                                    <h5>{{$notification->user->username}}</h5> <span class="mail-desc"><strong>{{$notification->notify}} </strong> - {{Str::limit($notification->comment->comments, 20)}}</span> <span class="time">{{$notification->created_at->diffForHumans()}}</span> </div>
                                            </a>
                                        @endif
                                        @endif

                                        @if($notification->type == env('REPORTER_NOTIFY'))
                                            @if($notification->user)
                                                @if(Auth::guard('admin')->user()->role_id != env('ADMIN'))
                                                <a onclick="readNotify('{{$notification->id}}')" href="{{route('user_profile', $notification->user->username)}}">
                                                @endif
                                                @if(Auth::guard('admin')->user()->role_id == env('ADMIN'))
                                                <a onclick="readNotify('{{$notification->id}}')" href="{{route('reporterRequest.list')}}">
                                                @endif
                                                <div class="user-img"> <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->photo)}}" alt="user" class="img-circle"></div>
                                                <div class="mail-contnet">
                                                    <h5>{{$notification->user->username}}</h5> <span class="mail-desc"><strong>{{$notification->notify}} </strong> </span> <span class="time">{{$notification->created_at->diffForHumans()}}</span>
                                                </div>
                                            </a>
                                        @endif
                                        @endif

                                    @endforeach
                                </div>
                            </li>
                            @if(count($notifications)>6)
                            <li>
                                <a class="nav-link text-center link" href="{{route('notifications')}}"> <strong>See all </strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </li>
               
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('upload/images/users/thumb_image/'. Auth::guard('admin')->user()->photo)}}" alt="user" class=""> <span class="hidden-md-down"> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="{{route('admin.profileUpdate')}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <a href="{{route('admin.passwordChange')}}" class="dropdown-item"><i class="ti-wallet"></i> Password Change</a>
                     
                        <a href="{{route('generalSetting')}}" class="dropdown-item"><i class="ti-settings"></i> Setting</a>
                       
                        <a  href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                        <form id="logout-form" action="{{ route('adminLogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
               
            </ul>
        </div>
    </nav>
</header>
