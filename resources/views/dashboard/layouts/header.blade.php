<header class="main-header">
	<!-- Logo -->
	<a href="javascript:void(0)" class="logo">
		<span class="logo-mini"><b>A</b></span>
		<span class="logo-lg"><b>{{ isset($page_title) ? $page_title : 'ALDMIC' }}</b></span>
	</a>
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown messages-menu">
					<a href="/" target="_blank">
						<i class="fa fa-globe"></i> Ke Website
					</a>
				</li>
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
						<span class="hidden-xs">Admin</span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
							<p>
								Admin
							</p>
						</li>
						<li class="user-footer">
							<a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-block">
								<span>Logout</span>
							</a>
							<form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>