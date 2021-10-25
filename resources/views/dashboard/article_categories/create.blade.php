@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tambah Data</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('console/facilities') }}"><i class="fa fa-bookmark-o"></i> Faciities</a></li>
			<li class="active">Tambah Data</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/facilities') }}" enctype="multipart/form-data">
						@csrf
						<div class="box-body">
							<div class="form-group @error('name') has-error @enderror">
								<label>Nama Fasilitas <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required placeholder="Nama Fasilitas" value="{{ old('name') }}">
								@error('name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('url') has-error @enderror">
								<label>Url <small class="text-warning">(Harus mengandung http:// atau https://)</small> <span class="text-danger">*</span></label>
								<input type="text" name="url" class="form-control" required placeholder="contoh: https://google.com" value="{{ old('url') }}">
								@error('url')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('image') has-error @enderror">
								<label>Gambar <span class="text-danger">*</span></label>
								<input type="file" name="image" class="form-control" required value="{{ old('image') }}">
								@error('image')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Submit</button>
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
		$('form').submit(function(){
			$('#btn_submit').attr('disabled',true).text('Submitting...');
		});
	});
</script>
@endpush