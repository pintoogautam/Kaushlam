<nav>
    <ul class="nav" >
		<li><a href="{{url('/admin')}}" class="{{(url()->current() == url('/admin/')) ?'active':'' }}">
		<i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
		

		<li><a href="{{url('/admin/user')}}" class="{{(url()->current() == url('/admin/user')) ?'active':'' }}">
		<i class="fa fa-users" aria-hidden="true"></i> Users</a></li>

		<li><a href="{{url('/admin/message')}}" class="{{(url()->current() == url('/admin/message')) ?'active':'' }}">
		<i class="fa fa-envelope" aria-hidden="true"></i> Message</a></li>

		<li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">
		<i class="fa fa-globe" aria-hidden="true"></i> Locations</a>
			<ul class="nav collapse {{ (url()->current() == url('/admin/country') || url()->current() == url('/admin/state') || url()->current() == url('/admin/city')) ? 'show' : '' }}" id="submenu1" role="menu" aria-labelledby="btn-1">
				
				<li><a href="{{url('/admin/country')}}" class="{{(url()->current() == url('/admin/country')) ?'active':'' }}">Country</a></li>
			
				<li><a href="{{url('/admin/state')}}" class="{{(url()->current() == url('/admin/state')) ?'active':'' }}">State</a></li>
				
				<li><a href="{{url('/admin/city')}}" class="{{(url()->current() == url('/admin/city')) ?'active':'' }}">City</a></li>
				
				<li><a href="{{url('/admin/zipcode')}}" class="{{(url()->current() == url('/admin/zipcode')) ?'active':'' }}">Zipcode</a></li>
			</ul>
		</li>

		<li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu2" aria-expanded="false">
		<i class="fa fa-mortar-board" aria-hidden="true"></i> Education</a>
			<ul class="nav collapse {{ (url()->current() == url('/admin/education') || url()->current() == url('/admin/branch')) ? 'show' : '' }}" id="submenu2" role="menu" aria-labelledby="btn-1">
			
			<li><a href="{{url('/admin/education')}}" class="{{(url()->current() == url('/admin/education')) ?'active':'' }}">
		 Education</a></li>
		
		<li><a href="{{url('/admin/branch')}}" class="{{(url()->current() == url('/admin/branch')) ?'active':'' }}">
		Branches</a></li>
			
			</ul>
		</li>
 
		<li><a href="{{url('/admin/advertisement')}}" class="{{(url()->current() == url('/admin/advertisement')) ?'active':'' }}">
		<i class="fa fa-bullhorn" aria-hidden="true"></i> Advertisments </a></li>
		
		<li><a href="{{url('/admin/order')}}" class="{{(url()->current() == url('/admin/order')) ?'active':'' }}">
		<i class="fa fa-reorder" aria-hidden="true"></i> Orders</a></li>

		<li><a href="{{url('/admin/setting')}}" class="{{(url()->current() == url('/admin/setting')) ?'active':'' }}">
		<i class="fa fa-gear" aria-hidden="true"></i> Settings</a></li>
	
		<li><a href="{{url('/admin/sliders')}}" class="{{(url()->current() == url('/admin/slider')) ?'active':'' }}">
		<i class="fa fa-sliders" aria-hidden="true"></i> Slider</a></li>
		
		<li><a href="{{url('/admin/cart')}}" class="{{(url()->current() == url('/admin/cart')) ?'active':'' }}">
		<i class="fa fa-shopping-cart" aria-hidden="true"></i> Carts</a></li>

		<li><a href="{{url('/admin/gift')}}" class="{{(url()->current() == url('/admin/gift')) ?'active':'' }}">
		<i class="fa fa-gift" aria-hidden="true"></i> Gifts</a></li>

		<li><a href="{{url('/admin/comment')}}" class="{{(url()->current() == url('/admin/comment')) ?'active':'' }}">
		<i class="fa fa-comments" aria-hidden="true"></i> Comments</a></li>


		
		

	
	</ul>
</nav>