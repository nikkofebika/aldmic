@extends('dashboard.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tambah Data</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('dashboard/pegawai') }}"><i class="fa fa-bookmark-o"></i> Pegawai</a></li>
			<li class="active">Tambah Data</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ route('dashboard.pegawai.store') }}">
						@csrf
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group @error('nik') has-error @enderror">
										<label>NIK <span class="text-danger">*</span></label>
										<input type="text" name="nik" class="form-control" required placeholder="NIK pegawai" value="{{ old('nik') }}">
										@error('nik')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group @error('full_name') has-error @enderror">
										<label>Nama <span class="text-danger">*</span></label>
										<input type="text" name="full_name" class="form-control" required placeholder="Nama pegawai" value="{{ old('full_name') }}">
										@error('full_name')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group @error('email') has-error @enderror">
										<label>Email <span class="text-danger">*</span></label>
										<input type="email" name="email" class="form-control" required placeholder="Alamat email" value="{{ old('email') }}">
										@error('email')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group @error('mobile_number') has-error @enderror">
										<label>No. Handphone <span class="text-danger">*</span></label>
										<input type="text" name="mobile_number" class="form-control" required placeholder="No. Handphone" value="{{ old('mobile_number') }}">
										@error('mobile_number')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group @error('address') has-error @enderror">
								<label>No. Handphone <span class="text-danger">*</span></label>
								<textarea name="address" class="form-control" required placeholder="Alamat pegawai" rows="5">{{ old('address') }}</textarea>
								@error('address')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection