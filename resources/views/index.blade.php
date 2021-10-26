<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ isset($page_title) ? $page_title : 'ALDMIC' }}</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					@empty(session()->get('auth'))
					<li><a href="{{ url('login') }}" target="_blank">Login</a></li>
					@else
					<li><a href="{{ url('dashboard/pegawai') }}" target="_blank">Dashboard</a></li>
					@endempty
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-5">
				<center>
					<form>
						@csrf
						<div class="form-group">
							<input type="text" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK pegawai" style="width: 60%">
						</div>
					</form>
					<strong id="time"></strong>
				</center>
			</div>
		</div>
	</div>
	<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
	<script type="text/javascript">
		var timestamp = '<?=time();?>';
		var date;
		function updateTime(){
			date = Date(timestamp);
			$('#time').html(date);
			timestamp++;
		}
		$(function(){
			setInterval(updateTime, 1000);
		});
		jQuery(document).ready(function($) {
			$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
			$('form').on('submit', function(e){
				e.preventDefault();
				$.post('{{ url("absen") }}', {nik: $('#nik').val()}, function(res){
					if (res.success){
						toastr.success(res.message);
					} else {
						toastr.error(res.message);
					}
				});
			})
		});
	</script>
</body>
</html>