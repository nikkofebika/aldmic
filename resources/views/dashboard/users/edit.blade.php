@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Edit Data</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('console/users') }}"><i class="fa fa-users"></i> Users</a></li>
			<li class="active">Edit Data</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/users/'.$user->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="box-body">
							<div class="form-group @error('name') has-error @enderror">
								<label>Nama <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required placeholder="Nama Lengkap" value="{{ $user->name }}">
								@error('name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('email') has-error @enderror">
								<label>Email <span class="text-danger">*</span></label>
								<input type="email" name="email" class="form-control" required placeholder="Alamat Email" value="{{ $user->email }}">
								@error('email')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('password') has-error @enderror">
								<label>Password <small class="text-warning">(Isi untuk mengganti password)</small></label>
								<div class="input-group">
									<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
									<span class="input-group-addon" id="btnShowHide"><i class="fa fa-eye"></i></span>
									<span class="input-group-append"></span>
								</div>
								@error('password')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('is_admin') has-error @enderror">
								<label>Tipe <span class="text-danger">*</span></label>
								<select name="is_admin" class="form-control" required>
									<option value="1" <?php echo $user->is_admin == 1 ? 'selected' : '' ?>>Admin</option>
									<option value="0" <?php echo $user->is_admin == 0 ? 'selected' : '' ?>>User</option>
									option
								</select>
								@error('is_admin')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('photo') has-error @enderror">
								<label>Gambar <small class="text-warning">(Upload ulang untuk mengganti gambar)</small></label>
								<input type="file" name="photo" class="form-control" value="{{ old('photo') }}">
								<a href="" title=""><img src="{{ asset($user->photo) }}" width="200"></a>
								@error('photo')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script>
	$(function () {
		x = document.getElementById("password");
		$('#btnShowHide').click(function(){
			if (x.type === "password") {
				$(this).children().removeClass('fa-eye').addClass('fa-eye-slash')
				x.type = "text";
			} else {
				x.type = "password";
				$(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
			}
		})
	});
</script>
@endpush