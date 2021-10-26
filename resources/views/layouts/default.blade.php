<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Cafe</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="{{ asset('assets/img/logo_cafe.png') }}" rel="icon">
	<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	@stack('styles')
	<style type="text/css">
		.swiper {
			width: 100%;
			height: 100%;
		}

		.swiper-slide {
			text-align: center;
			font-size: 18px;
			background: #fff;

			/* Center slide text vertically */
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
		}

		.swiper-slide img {
			display: block;
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
	</style>
</head>
<body>
	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex align-items-center">
			<a class="logo me-auto" href="{{ url('') }}">
				<img src="{{ asset('assets/img/logo/logo_cafe.png') }}">
			</a>
			<nav id="navbar" class="navbar">
				<ul>
					<li><a href="{{ url('') }}" class="active">Home</a></li>
					<li class="dropdown"><a href="#"><span>News/Event</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="{{ url('bulletin') }}">Monthly Culture</a></li>
							<li><a href="{{ url('bulletin') }}">Company Bulletin</a></li>
							<li><a href="{{ url('bulletin') }}">Employee Challenge</a></li>
							<li><a href="{{ url('bulletin') }}">Up coming company event</a></li>
						</ul>
					</li>
					<li><a href="{{ url('facilities') }}">Facilities</a></li>
					<li><a href="{{ url('company-policy') }}">Employee Benefit</a></li>
					<li><a href="{{ url('company-policy') }}">Company Policy</a></li>
					<!-- <li class="dropdown"><a href="pricing.html">Company Policy <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="{{ url('') }}">Peraturan Perusahaan</a></li>
							<li><a href="{{ url('') }}">SK Medical</a></li>
							<li><a href="{{ url('') }}">SK Perjalanan Dinas</a></li>
							<li><a href="{{ url('') }}">SK Tunjangan Pulsa</a></li>
							<li><a href="{{ url('') }}">SOP Klaim & Reimbursement</a></li>
							<li><a href="{{ url('') }}">Company Facilities guideline</a></li>
						</ul>
					</li> -->
					@auth
					@if(request()->route()->getPrefix() == '/dashboard')
					<li><a href="javascript:void(0)" class="getstarted" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
					@else
					<li><a href="{{ url('dashboard') }}" class="getstarted">Akun Saya</a></li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
					@endif
					@else
					<li><a href="javascript:void(0)" class="getstarted" data-bs-toggle="modal" data-bs-target="#mdlLogin">Login</a></li>
					@endauth
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav>
		</div>
	</header>
	<main id="main">
		@yield('content')
	</main>
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-4 col-md-6">
						<div class="footer-info">
							<img src="{{ asset('assets/img/logo/logo_triputra.png') }}">
							<p>
								The Bellezza Permata Hijau, Office Tower Lt. 26 Jalan Letjen Soepeno No. 34 Arteri Permata Hijau - Jakarta Selatan 12210.<br><br>
								<strong>Phone:</strong> +1 5589 55488 55<br>
								<strong>Email:</strong> info@example.com<br>
							</p>
							<div class="social-links mt-3">
								<a title="Twitter" href="https://twitter.com/koranjakarta_id" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
								<a title="Facebook" href="https://www.facebook.com/koranmediajakarta" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
								<a title="Instagram" href="https://www.instagram.com/koranjakarta.id" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
								<a title="Youtube" href="https://www.youtube.com/channel/UCLZE61FTyKT8BcySON39JfQ" target="_blank" class="google-plus"><i class="bx bxl-youtube"></i></a>
								<a title="LinkedIn" href="https://www.linkedin.com/company/koranjakarta/" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Useful Links</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Our Services</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="https://triputraenergi.com/id/" target="_blank">Triputra Energi Megatara</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void" target="_blank">Oracle</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void" target="_blank">Aplikasi lainnya</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void" target="_blank">Aplikasi lainnya</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void" target="_blank">Aplikasi lainnya</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">&copy; Copyright <strong><span>Triputra</span></strong>. All Rights Reserved</div>
		</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	@guest
	<div class="modal fade" id="mdlLogin" tabindex="-1" aria-labelledby="mdlLoginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group mb-2">
							<label>Email</label>
							<input name="email" type="email" class="form-control" placeholder="name@example.com">
						</div>
						<label>Password</label>
						<div class="input-group">
							<input name="password" id="inputPassword" type="password" class="form-control border-end-0" placeholder="Password">
							<span class="input-group-text border-start-0 bg-white" id="btnShowHide"><i id="iconShowHide" class="bx bx-show"></i></span>
						</div>
						<div class="checkbox my-2">
							<label>
								<input type="checkbox" value="remember-me"> Remember me
							</label>
						</div>
						<button class="w-100 btn btn-primary" type="submit">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		const btnShowHide = document.getElementById('btnShowHide');
		const inputPassword = document.getElementById('inputPassword');
		let iconType = '';
		let inputType = '';
		btnShowHide.addEventListener('click', function (e) {
			if (inputPassword.getAttribute('type') === 'password') {
				inputType = 'text';
				iconType = 'bx bx-hide';
			} else {
				inputType = 'password';
				iconType = 'bx bx-show';
			}
			inputPassword.setAttribute('type', inputType);
			document.getElementById('iconShowHide').className = iconType;
		});
	</script>
	@endguest
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
	<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
	@stack('scripts')
</body>
</html>