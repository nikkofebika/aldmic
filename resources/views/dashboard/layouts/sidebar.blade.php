<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>Admin</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<?php $active_menu = isset($active_menu) ? $active_menu : '' ?>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="{{ $active_menu == 'pegawai' ? 'active' : '' }}">
				<a href="{{ url('dashboard/pegawai') }}">
					<i class="fa fa-users"></i> <span>Pegawai</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'absensi' ? 'active' : '' }}">
				<a href="{{ url('dashboard/absensi') }}">
					<i class="fa fa-clock-o"></i> <span>Absensi</span>
				</a>
			</li>
			<li>
				<a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i> <span>Logout</span>
				</a>
				<form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			</li>
		</ul>
	</section>
</aside>