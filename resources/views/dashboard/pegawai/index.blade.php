@extends('dashboard.layouts.master')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{$page_title}}</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bookmark-o"></i> {{ $page_title }}</a></li>
			<li class="active">All</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<?php if(session('notification')){echo session('notification');} ?>
						<a href="{{ url('dashboard/pegawai/export') }}" title="Export CSV" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export CSV</a>
						<a href="{{ url('dashboard/pegawai/create') }}" title="Tambah Data" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nik</th>
										<th>Nama</th>
										<th>Email</th>
										<th>No. Handphone</th>
										<th></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="mdlView">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Pegawai</h4>
			</div>
			<div class="modal-body">
				<center><img src="{{ asset('images/gif/loader2.gif') }}"> Loading...</center>
			</div>
		</div>
	</div>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('dashboard.pegawai.list') }}",
			columns: [
			{data: 'id', sortable: 'false',
			render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{data: 'nik', name: 'nik'},
			{data: 'full_name', name: 'full_name'},
			{data: 'email', name: 'email'},
			{data: 'mobile_number', name: 'mobile_number'},
			{
				data: 'action',
				name: 'action',
				orderable: false, 
				searchable: false
			},
			]
		});

		$('#mdlView').on('show.bs.modal', function(e){
			var id = $(e.relatedTarget).data('id');
			$.get('{{ url("dashboard/pegawai") }}/' + id, function(html){
				$('#mdlView div.modal-body').html(html);
			});
		}).on('hidden.bs.modal', function(){
			$('#mdlView div.modal-body').html('<center><img src="{{ asset('images/gif/loader2.gif') }}"> Loading...</center>');
		});
	});
</script>
@endpush