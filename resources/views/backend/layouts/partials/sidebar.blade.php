<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</a>
                </li>

            @if(Auth::user()->role_id == 1)
                <li><a href="{{route('admin.homepageSection')}}"><i class="ti-settings"></i><span class="hide-menu"> Homepage</a></span></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Category</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('category.create') }}">Add Category</a></li>
                        <li><a href="{{ route('category.list') }}">Category List</a></li>
                        <li><a href="{{ route('subcategory.create') }}">Add Subcategory</a></li>
                        <li><a href="{{ route('subcategory.list') }}">Subcategory List</a></li>
                        <li><a href="{{ route('speciality.create') }}">Add Speciality </a></li>
                        <li><a href="{{ route('speciality.list') }}">Speciality List</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Desh Jure</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- <li><a href="{{route('division.index')}}">Add Division</a></li> -->
                        <li><a href="{{route('district.index')}}">Add District</a></li>
                        <li><a href="{{route('upzilla.index')}}">Add Upzilla</a></li>
                    </ul>
                </li>
            @endif
             @php $allPendingNews = App\Models\News::where('status', 'pending')->count(); @endphp
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">বাংলা সংবাদ  <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('news.create')}}">Create News</a></li>
                        <li><a href="{{route('news.list')}}">All News</a></li>
                        <li><a href="{{route('news.list', 'pending')}}">Pending News <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></a></li>
                        <li><a href="{{route('news.list', 'bd')}}">Bangla News</a></li>
                        <li><a href="{{route('news.list', 'en')}}">English News</a></li>
                    </ul>
                </li>
                @php $englishPendingNews = App\Models\News::where('lang','=', 2)->where('status', 0)->count(); @endphp
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">English News <span class="badge badge-pill badge-cyan ml-auto">{{ $englishPendingNews }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('englishNews.create')}}">Create English News</a></li>
                        <li><a href="{{route('englishNews.list')}}">All English News</a></li>
                        <li><a href="{{route('englishNews.list', 'pending')}}">Pending News <span class="badge badge-pill badge-cyan ml-auto">{{ $englishPendingNews }}</span></a></li> 
                        <li><a href="{{route('englishNews.list', 'draft')}}">Draft News</a></li>
                        
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Media Gallery</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('phato.gallery')}}">Phato Gallery</a></li>
                        <li><a href="{{route('video.gallery')}}">Video Gallery</a></li>
                    </ul>
                </li>
           
                
            @if(Auth::user()->role_id == 1)
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Manage Users </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('admin.user.list')}}">Users</a></li>
                        <li><a href="#">Users Pending</a></li>
                    
                    </ul>
                </li>


                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Reporter </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.create')}}">Add Reporter</a></li>
                        <li><a href="{{route('reporter.list')}}">Reporter List</a></li>
                    </ul>
                </li>    

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Reporter Requst</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporterRequest.list')}}">Reporter Request</a></li>
                        <li><a href="{{route('reporterRequest.rejectedList')}}">Rejected Request</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Advertisement</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('addvertisement.create')}}">Advertisement</a></li>
                        <li><a href="{{route('addvertisement.list')}}">Advertisement Setting</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-media-right-alt"></i><span class="hide-menu">Page</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('page.create')}}">Create Page</a></li>
                        <li><a href="{{route('page.list')}}">Page list</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('admin.poll.list') }}" aria-expanded="false"><i class="ti-layout-accordion-merged"></i><span class="hide-menu">Polls</a>
                </li>
               
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Subscription</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Subscription</a></li>
                        <li><a href="#">Subscription List</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-comment"></i><span class="hide-menu">Comments</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('allComments')}}">Comments</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('generalSetting')}}">General Setting</a></li>
                        <li><a href="{{route('admin.profileUpdate')}}">Profile Setting</a></li>
                        
                        <li><a href="{{route('logoSetting')}}">Logo Setting</a></li>
                        <li><a href="{{route('googleSetting')}}">Google Setting</a></li>
                        <li><a href="{{route('admin.passwordChange')}}">Change Password</a></li>
                        <li><a href="{{route('socialLoginSetting')}}">Social Media Login</a></li>
                        <li><a href="{{route('socialSetting')}}">Social Link</a></li>
                    </ul>
                </li>
            @endif
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-bell"></i><span class="hide-menu">Notifications</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('notifications')}}">Notifications</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="far fa-circle text-success"></i><span class="hide-menu">Log Out</span></a>
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
