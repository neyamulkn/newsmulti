<div class="sidebar ">
	<div class=" review-widget">
		<ul class="review-posts-list">
			<li style="height: 200px;cursor: pointer" data-toggle="modal" data-target="#update_profile">
				<img style="max-width: 100%;max-height: 100%; object-fit: contain;" src="{{asset('upload/images/users/'. Auth::user()->photo)}}" alt="">
			</li>
		</ul>
	</div>
	<div class="widget categories-widget">
		<ul class="category-list user-profile">
			
				<li class="profile">
					<a href="{{route('user.myProfile')}}" ><i class="fa fa-user" aria-hidden="true"></i>  Profile <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
				</li>
				
				<li>
					<a href="{{route('reporterRegister')}}"><i class="fa fa-fw fa-user"></i> Request For Reporter  </a>
				</li>
				
				<li>
					<a href="#"><i class="fa fa-fw fa-envelope"></i> Messages  <span>0</span></a>
				</li>
				<li>
					<a href="#"><i class="fa fa-fw fa-bell"></i> Notifications  <span>0</span></a>
				</li>
			
			
			
			<li>
				<a href="{{route('viewReadLater')}}"><i class="fa fa-book"></i> Read Later <span>({{ App\Models\ReadLater::where('user_id',  Auth::id())->count()}})</span></a>
			</li>

			<li>
				<a href="#"><i class="fa fa-line-chart"></i> Level  <span>0</span></a>
			</li>

			<li>
				<a href="#"><i class="fa fa-fw fa-user"></i> My Point  <span>0</span></a>
			</li>
			@if(Auth::check())
			<li>
				<a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>
                <!-- text-->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</li>
			@endif
		</ul>
	</div>
</div>