<style type="text/css">
    .notification{border-bottom: 1px solid #eae6e6;}
    .navbar .dropdown-menu{
        right: 0;
        left: initial;
    }
    .notification img{
        width: 40px;
        height: 40px;
        padding-right: 5px;
    }
    .notification p{padding-left: 42px;margin-top: -10px;}
    .notify{border-radius: 50%;
background: #f14133;
position: absolute;
top: -4px;
right: -6px;
padding: 0px 2px;
color: white;}
</style>
<!-- Header
    ================================================== -->
<header class="clearfix second-style">
    <!-- Bootstrap navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">

        <!-- Top line -->
        <div class="top-line" style="overflow: initial;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3" style="width: 22%">
                        <ul class="top-line-list">
                            <?PHP

                            $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

                            $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
                            $convertedDATE = str_replace($engDATE, $bangDATE, date("l, F j, Y"));

                            ?>
                            <li><span class="time-now">{{$convertedDATE}} | @include('frontend.layouts.banglayear')</span></li>
                       </ul>
                    </div>
                    <div class="col-md-8" style="width: 68%;float: right;">
                        
                        <ul class="social-icons">
                            
                            <li><a style="color:#0fe8d2;font-weight:500" href="{{url('advertising')}}"><i class="menu-style fa fa-bullhorn"></i> বিজ্ঞাপন </a></li>
                            <li><a style="color:#0fe8d2;font-weight:500" href="http://facebook.com/bdtype"><i class="menu-style fa fa-archive"></i> আর্কাইভ  </a></li>
                            <li><a style="color:#0fe8d2;font-weight:500" href="http://facebook.com/bdtype"><i class="menu-style fa fa-calendar"></i> কুইজ  </a></li>
                            @if(Auth::guard('admin')->check())
                            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            @elseif(Auth::guard('reporter')->check())
                            <li><a href="{{route('reporter.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            @else

                            @endif

                            @guest
                            <li style="padding: 0px 5px;border: 1px solid #00fae1; border-radius: 10px;"><a class="" href="{{route('login')}}"><i class="fa fa-lock" aria-hidden="true"></i> Login</a></li>
                            @else
                           <?php $notifications = App\Models\Notification::where('toUser', Auth::id())->orderBy('id', 'desc')->get(); ?>
                            <li style="padding: 0px 5px;border: 1px solid #00fae1; border-radius: 10px;" class="dropdown">
                                <button class="profileBtn dropdown-toggle" type="button" data-toggle="dropdown"><i style="position: relative;" class="fa fa-bell-o"><span class="notify">{{count($notifications->where('read', 0))}}</span></i>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    
                                    @foreach($notifications->take(7) as $notification)
                                       
                                        @if($notification->type == env('NEWS'))
                                        @if($notification->news)
                                            <li class="notification">
                                                <a onclick="readNotify('{{$notification->id}}')" @if($notification->news->status == 1) href="{{route('news.list')}}" @elseif($notification->news->status == 2) href="{{route('news.list', 'draft')}}" @else  href="{{route('news.list', 'pending')}}" @endif>
                                                <img src="{{asset('upload/images/users/thumb_image/'.$notification->user->image)}}"><strong>{{$notification->user->username}} </strong>- {{$notification->notify}}
                                                <p style="color: #969696"><i class="fa fa-clock-o"> </i> {{$notification->created_at->diffForHumans()}}</p>
                                                <p>{{Str::limit($notification->news->news_title, 20)}}</p>
                                                </a>
                                            </li> 
                                        @endif
                                        @endif

                                    @endforeach
                                    @if(count($notifications)>6)
                                    <li><a href="{{route('notifications')}}"> Show All </a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="dropdown" style="padding: 0px 5px;">
                                <button class="profileBtn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user"></i>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    
                                    <li><a href="{{route('user.myProfile')}}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>

                                    <li><a href="#"><i class="fa fa-envelope-o"></i> Inbox</a></li>

                                    <li><a href="{{route('viewReadLater',  Auth::user()->username)}}"><i class="fa fa-book" aria-hidden="true"></i> Read Later</a></li>
                                    <li><a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Forum</a></li>
                                    <li><a href="{{route('viewReadLater',  Auth::user()->username)}}"><i class="fa fa-cog"></i> Setting</a></li>
                                    <li class="divider"></li>
                                    <li><a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                        <!-- text-->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                           
                            @endguest
                            @php
                              if(!Session::has('socialLists')){
                                  Session::put('socialLists', App\Models\Social::where('status', 1)->get());
                              }
                            @endphp
                            @foreach(Session::get('socialLists') as $social)
                            <li><a style="background:{{$social->background}}; color:{{$social->text_color}}" href="{{$social->link}}"><i class="fa {{$social->icon}}"></i></a></li>
                            @endforeach
                           
                            @if(Session::get('locale'))
                            <li><a  style="background: #f44336; color: #fff;" class="google" href="{{url('lang/bd')}}"><i class="fa fa-language"> </i> বাংলা</a></li>
                             
                            @else
                             <li><a style="background: #f44336; color: #fff;" class="google" href="{{url('lang/en')}}"><i class="fa fa-language"> </i> English</a></li>
                              
                            @endif
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top line -->

        <!-- Logo & advertisement -->
        <div class="logo-advertisement">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="mobile-menu"  data-target="#sidebarCollapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" width="240" alt=""></a>
                </div>
            
                <div class="advertisement" style="padding: 0px !important">
                    <div class="desktop-advert">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- bdtype ads -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:728px;height:90px"
                             data-ad-client="ca-pub-5013283859692183"
                             data-ad-slot="6785753713"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End Logo & advertisement -->
    <?php $category_menus = \App\Models\Category::where('status', 1)->orderBy('position', 'ASC')->get(); $i = 1; $total_menu = $category_menus->count(); ?>
    <!-- menu-sidebar  -->
        <nav id="menu-sidebar" class="active">
            <ul class="list-unstyled components">

                @foreach($category_menus as $menu)
                    <li>
                        <a href="{{(count($menu->subcategory)>0)?
                            '#'. $menu->category_en : route('category', [$menu->cat_slug_en]) }}" @if(count($menu->subcategory)>0) data-toggle="collapse" aria-expanded="false" class="dropdownIcon dropdown-toggle" @endif >{{$menu->category_bd}}</a>
                        @if(count($menu->subcategory)>0)
                            <ul class="collapse list-unstyled" class="collapse list-unstyled" id="{{$menu->category_en}}">
                                @foreach($menu->subcategory as $subcategory)
                                    <li><a href="{{ route('category', [$menu->cat_slug_en, $subcategory->subcat_slug_en]) }}">{{$subcategory->subcategory_bd}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                <li>
                    @guest
                        <a class="google" href="{{route('login')}}">Login</a>
                    @else
                        <li>
                            <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdownIcon dropdown-toggle">Profile</a>

                            <ul class="collapse list-unstyled" class="collapse list-unstyled" id="profile">
                                @if(Auth::user()->role_id != 3)
                                <li><a href="{{route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                @endif
                                <li><a href="{{route('user.myProfile')}}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>

                                <li><a href="#"><i class="fa fa-envelope-o"></i> Inbox</a></li>

                                <li><a href="{{route('viewReadLater')}}"><i class="fa fa-book" aria-hidden="true"></i> Read Later</a></li>
                                <li><a href="#"><i class="fa fa-external-link" aria-hidden="true"></i> Forum</a></li>
                                <li><a href="{{route('viewReadLater')}}"><i class="fa fa-cog"></i> Setting</a></li>
                                <li class="divider"></li>
                                <li><a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                    <!-- text-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                    @endguest
                </li>
                 @if(Session::get('locale'))
                <li><a  style="background: #f44336; color: #fff;" class="google" href="{{url('lang/bd')}}"><i class="fa fa-language"> </i> বাংলা</a></li>
                 
                @else
                 <li><a style="background: #f44336; color: #fff;" class="google" href="{{url('lang/en')}}"><i class="fa fa-language"> </i> English</a></li>
                  
                @endif
                
            </ul>
        </nav>
        <div class="nav-list-container">               
            <!-- navbar list container -->
            <div style="border-bottom: 3px solid #005D32">
                <div class="container">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-left">

                            <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                @foreach($category_menus as $menu)
                                    @if($i<=11)
                                        <li class="drop"><a class="home @if(count($menu->subcategory)>0) dropdownIcon @endif" href="{{ route('category', [$menu->cat_slug_en]) }}">{{$menu->category_bd}}  @if($menu->cat_slug_en == "live-tv")<sub style="color: red"> {{ __('lang.live') }} </sub> @endif</a>
                                            @if(count($menu->subcategory)>0)
                                                <ul class="dropdown">
                                                    @foreach($menu->subcategory as $subcategory)
                                                        <li><a href="{{ route('category', [$menu->cat_slug_en, $subcategory->subcat_slug_en]) }}">{{$subcategory->subcategory_bd}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @endif
                                    <?php $i++; ?>
                                @endforeach
                                 <li><a href="{{route('gallery')}}">{{__('lang.picture')}}</a></li>
                                <li><a href="{{route('video')}}">{{__('lang.video')}}</a></li>

                                <div class="s128" >
                                    <form action="{{route('search_result')}}" method="get" method="get">
                                        <div class="inner-form">
                                            <div class="src-box">
                                                <div class="input-field second">

                                                    <input type="text" id="src" autocomplete="off" onkeyup="search_bar(this.value)" value="{{Request::get('q')}}" name="q" placeholder="Search news">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="search_bar" id="search_bar" >
                                        <ul class="list-posts">
                                            <span id="show_suggest_key"></span>
                                        </ul>
                                    </div>
                                </div>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </div>

        <!-- End navbar list container -->
        @if(count($category_menus)>11)
        <div class="second-menu">
            <div class="container">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">

                        <?php $j = 1; ?>
                            @foreach($category_menus as $menu)
                                @if($j>11)
                                    <li class="drop"><a class="home @if(count($menu->subcategory)>0) dropdownIcon @endif" href="{{ route('category', [$menu->cat_slug_en]) }}">{{$menu->category_bd}}  @if($menu->cat_slug_en == "live-tv")<sub style="color: red">{{ __('lang.live') }}</sub> @endif</a>
                                        @if(count($menu->subcategory)>0)
                                            <ul class="dropdown">
                                                @foreach($menu->subcategory as $subcategory)
                                                    <li><a href="{{ route('category', [$menu->cat_slug_en, $subcategory->subcat_slug_en]) }}">{{$subcategory->subcategory_bd}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            <?php $j++; ?>
                        @endforeach

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>
        @endif
    </nav>
    <!-- End Bootstrap navbar -->

</header>
<!-- End Header -->
