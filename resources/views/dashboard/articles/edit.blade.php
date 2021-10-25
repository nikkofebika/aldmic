@extends('console.layouts.master')
@push('styles')
<link href="{{ asset('backend/bower_components/summernote/summernote.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tambah Data</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('console/articles') }}"><i class="fa fa-newspaper-o"></i> Bulletin</a></li>
			<li class="active">Tambah Data</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/articles/'.$article->id) }}" enctype="multipart/form-data">
						@csrf @method('PUT')
						<div class="box-body">
							<div class="form-group @error('title') has-error @enderror">
								<label>Judul <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" required placeholder="Judul Buletin" value="{{ $article->title }}">
								@error('title')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<label>Approve Status <span class="text-danger">*</span></label>
								<br>
								<label class="radio-inline">
									<input type="radio" name="approved" required value="1" {{ $article->approved == 1 ? 'checked' : '' }}> Ya
								</label>
								<label class="radio-inline">
									<input type="radio" name="approved" required value="0" {{ $article->approved == 0 ? 'checked' : '' }}> Tidak
								</label>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('image') has-error @enderror">
										<label>Gambar <small class="text-warning">(Upload ulang untuk mengganti gambar)</small></label>
										<input type="file" name="image" class="form-control" value="{{ old('image') }}">
										<a href="" title=""><img src="{{ asset($article->image) }}" width="200"></a>
										@error('image')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('published_at') has-error @enderror">
										<label>Waktu Tayang <span class="text-danger">*</span></label>
										<input type="text" name="published_at" class="form-control" id="datetimepicker" required value="{{ date('Y-m-d H:i', strtotime($article->published_at)) }}" readonly/>
										@error('published_at')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group @error('description') has-error @enderror">
								<label>Description <span class="text-danger">*</span></label>
								<textarea name="description" id="summernote" class="form-control" rows="5" required>{{ $article->description }}</textarea>
								@error('description')
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
<script src="{{ asset('backend/bower_components/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
	$(function () {
		$('#datetimepicker').datetimepicker({
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
		});
		$('#summernote').summernote({
			height: 500,
			placeholder: 'Tulis deskripsi disini...'
		});
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