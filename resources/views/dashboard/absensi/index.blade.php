@extends('dashboard.layouts.master')
@push('styles')
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
						<a href="{{ url('dashboard/absensi/export') }}" title="Export CSV" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export CSV</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nik</th>
										<th>Date Time</th>
										<th>Status</th>
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
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('dashboard.absensi.list') }}",
			columns: [
			{data: 'id', sortable: 'false',
			render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{data: 'nik', name: 'nik'},
			{data: 'date_time', name: 'date_time'},
			{data: 'in_out', name: 'in_out'},
			]
		});
	});
</script>
@endpush