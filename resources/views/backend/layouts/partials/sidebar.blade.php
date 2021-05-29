<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
       
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="padding: 0">
            <ul id="sidebarnav">
                 <!-- User Profile-->
                <li class="user-pro"> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><div style="float: left;"><img style="width: 40px;" src="{{asset('upload/images/users/thumb_image/'. Auth::guard('admin')->user()->photo)}}" alt="user-img" class="img-circle"></div>
                    <span class="hide-menu">{{Auth::guard('admin')->user()->name}} <br/> {{config('siteSetting.currency_symble') . Auth::guard('admin')->user()->wallet_balance}}</span></a>
                    
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</a>
                </li>

        
           
            @php 
            $allPendingNews = App\Models\News::where('status', 'pending')->count();
            $englishPendingNews = App\Models\News::where('lang','=', 'en')->where('status', 'pending')->count();
            $banglaPendingNews = App\Models\News::where('lang','=', 'bd')->where('status', 'pending')->count();
             @endphp
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-pencil-alt"></i><span class="hide-menu">News Section <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('news.create')}}">Create News</a></li>
                        <li><a href="{{route('news.list')}}">All News</a></li>
                         <li><a href="{{route('news.list', 'pending')}}">Pending News <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></a></li>
                        <li><a href="{{route('news.list', 'bd')}}">Bangla News <span class="badge badge-pill badge-cyan ml-auto">{{ $banglaPendingNews }}</span></a></li>
                        <li><a href="{{route('news.list', 'en')}}">English News <span class="badge badge-pill badge-cyan ml-auto">{{ $englishPendingNews }}</span></a></li>
                       
                        <li><a href="{{route('news.list', 'reject')}}">Reject News</a></li>

                        <li><a href="{{route('news.list', 'draft')}}">Draft News </a></li>

                        <li><a href="{{route('news.list', 'audio')}}">Audio News</a></li>
                        <li><a href="{{route('news.list', 'video')}}">Video News</a></li>
                        <li><a href="{{route('news.list', 'schedule')}}">Schedule News</a></li>
                        <li><a href="{{route('news.list', 'breaking')}}">Breaking News</a></li>
                        <li><a href="{{route('news.list', 'featured')}}">Featured News</a></li>
                    </ul>
                </li>

                <li><a href="{{route('admin.homepageSection')}}"><i class="ti-settings"></i><span class="hide-menu"> Homepage Setting</a></span></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-server"></i><span class="hide-menu">Category</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('category.list') }}">Category List</a></li>
                        <li><a href="{{ route('subcategory.list') }}">Subcategory List</a></li>
                        
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-flag"></i><span class="hide-menu">Desh Jure</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- <li><a href="{{route('division.index')}}">Add Division</a></li> -->
                        <li><a href="{{route('district.index')}}">Add District</a></li>
                        <li><a href="{{route('upzilla.index')}}">Add Upzilla</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-gallery"></i><span class="hide-menu">Media Gallery</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('photo.gallery')}}">Photo Gallery</a></li>
                        <li><a href="{{route('video.gallery')}}">Video Gallery</a></li>
                    </ul>
                </li>
           
                

                @php $pendingReporters = App\Models\Reporter::where('status', 'pending')->count(); @endphp
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-write"></i><span class="hide-menu">Reporter <span class="badge badge-pill badge-primary text-white ml-auto">{{$pendingReporters}}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.create')}}">Add Reporter</a></li>
                        <li><a href="{{route('reporter.list')}}">All Reporters</a></li>
                        <li><a href="{{route('reporter.list', 'pending')}}">Reporter Request <span class="badge badge-primary badge-cyan ml-auto">{{ $pendingReporters }}</span></a></li>
                    </ul>
                </li>    

               

                
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('generalSetting')}}">General Setting</a></li>
                        <li><a href="{{route('site_settings')}}">Site Settings</a></li>
                        <li><a href="{{route('admin.profileUpdate')}}">Profile Setting</a></li>
                        
                        <li><a href="{{route('logoSetting')}}">Logo Setting</a></li>
                        <li><a href="{{route('headerSetting')}}">Header Setting</a></li>
                        <li><a href="{{route('footerSetting')}}">Footer Setting</a></li>
                        <li><a href="{{route('seoSetting')}}">SEO Setting</a></li>
                        <li><a href="{{route('googleSetting')}}">Analytics & Adsense</a></li>
                        <li><a href="{{route('google_recaptcha')}}">Google reCaptcha</a></li>
                        <li><a href="{{route('admin.passwordChange')}}">Change Password</a></li>
                        <li><a href="{{route('socialLoginSetting')}}">Social Media Login</a></li>
                        <li><a href="{{route('socialSetting')}}">Social Link</a></li>
                    </ul>
                </li>
                
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Advertisement</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('addvertisement.list')}}">Advertisements</a></li>
                    </ul>
                </li>

            
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Wallet</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.transactions')}}">Transactions</a></li>
                        <li><a href="{{route('withdrawConfigure')}}">Withdraw Configure</a></li>
                        <li><a href="{{route('withdrawRequest')}}">Withdraw Request</a></li>
                        
                        <li><a href="{{route('paymentGateway')}}">Payment Gateway</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-file-word"></i><span class="hide-menu">Page</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('page.create')}}">Create Page</a></li>
                        <li><a href="{{route('page.list')}}">Page list</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('admin.poll.list') }}" aria-expanded="false"><i class="fa fa-hourglass-half"></i><span class="hide-menu">Polls</a>
                </li>
               
              
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-comment"></i><span class="hide-menu">Comments</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('allComments')}}">Comments</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Message</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('messageAdmin')}}">Message </a></li>
                    </ul>
                </li>

                
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">SMTP & OTP Config</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('otp_configurations')}}">OTP Configurations</a></li>
                        <li><a href="{{route('smtp_settings')}}">SMTP settings</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Manage Users </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.user.list')}}">Users</a></li>
                        <li><a href="#">Users Pending</a></li>
                    
                    </ul>
                </li>
                
                  <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Subscription</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Subscription</a></li>
                        <li><a href="#">Subscription List</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-bell"></i><span class="hide-menu">Notifications</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('notifications')}}">Notifications</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="icon-logout text-success"></i><span class="hide-menu">Log Out</span></a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
