@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Edit Data</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('console/facilities') }}"><i class="fa fa-bookmark-o"></i> Facilities</a></li>
			<li class="active">Edit Data</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/facilities/'.$facility->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="box-body">
							<div class="form-group @error('name') has-error @enderror">
								<label>Nama Fasilitas <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required placeholder="Nama Fasilitas" value="{{ $facility->name }}">
								@error('name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('url') has-error @enderror">
								<label>Url <small class="text-warning">(Harus mengandung http:// atau https://)</small> <span class="text-danger">*</span></label>
								<input type="text" name="url" class="form-control" required placeholder="contoh: https://google.com" value="{{ $facility->url }}">
								@error('url')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('image') has-error @enderror">
								<label>Gambar <small class="text-warning">(Upload ulang untuk mengganti gambar)</small></label>
								<input type="file" name="image" class="form-control" value="{{ old('image') }}">
								<a href="" title=""><img src="{{ asset($facility->image) }}" width="200"></a>
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