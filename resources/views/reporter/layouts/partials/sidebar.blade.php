<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="padding: 0">
            <ul id="sidebarnav">
                 <!-- User Profile-->
                <li class="user-pro"> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><div style="float: left;"><img style="width: 40px;" src="{{asset('upload/images/users/thumb_image/'. Auth::guard('reporter')->user()->photo)}}" alt="user-img" class="img-circle"></div>
                    <span class="hide-menu">{{Auth::guard('reporter')->user()->name}} <br/> {{config('siteSetting.currency_symble') . Auth::guard('reporter')->user()->wallet_balance}}</span></a>
                    
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('reporter.dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</a>
                </li>

        
            @php 
            $user_id = Auth::guard('reporter')->id();
            $allPendingNews = App\Models\News::where('user_id', $user_id)->where('status', 'pending')->count();
            $englishPendingNews = App\Models\News::where('user_id', $user_id)->where('lang','=', 'en')->where('status', 'pending')->count();
            $banglaPendingNews = App\Models\News::where('user_id', $user_id)->where('lang','=', 'bd')->where('status', 'pending')->count();
             @endphp
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-pencil-alt"></i><span class="hide-menu">News Section <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.news.create')}}">Create News</a></li>
                        <li><a href="{{route('reporter.news.list')}}">All News</a></li>
                         <li><a href="{{route('reporter.news.list', 'pending')}}">Pending News <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></a></li>
                        <li><a href="{{route('reporter.news.list', 'bd')}}">Bangla News <span class="badge badge-pill badge-cyan ml-auto">{{ $banglaPendingNews }}</span></a></li>
                        <li><a href="{{route('reporter.news.list', 'en')}}">English News <span class="badge badge-pill badge-cyan ml-auto">{{ $englishPendingNews }}</span></a></li>
                       
                        <li><a href="{{route('reporter.news.list', 'reject')}}">Reject News</a></li>

                        <li><a href="{{route('reporter.news.list', 'draft')}}">Draft News </a></li>

                        <li><a href="{{route('reporter.news.list', 'audio')}}">Audio News</a></li>
                        <li><a href="{{route('reporter.news.list', 'video')}}">Video News</a></li>
                        <li><a href="{{route('reporter.news.list', 'schedule')}}">Schedule News</a></li>
                        <li><a href="{{route('reporter.news.list', 'breaking')}}">Breaking News</a></li>
                        <li><a href="{{route('reporter.news.list', 'featured')}}">Featured News</a></li>
                    </ul>
                </li>
               

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Wallet</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.walletHistory')}}">Wallet History</a></li>
                       
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Media Gallery</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Photo Gallery</a></li>
                        <li><a href="#">Video Gallery</a></li>
                    </ul>
                </li>
           
         
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-comment"></i><span class="hide-menu">Comments</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Comments</a></li>
                    </ul>
                </li>
           
           
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-bell"></i><span class="hide-menu">Notifications</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Notifications</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="javascript:void(0)" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="far fa-circle text-success"></i><span class="hide-menu">Log Out</span></a>
                    <form id="logout-form" action="{{ route('reporterLogout') }}" method="POST" style="display: none;">
                         @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
