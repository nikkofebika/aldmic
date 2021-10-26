<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use DataTables;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
	public function index() {
		return view('dashboard.absensi.index', ['page_title' => 'Absensi', 'active_menu' => 'absensi']);
	}

	public function getAbsensi(Request $request) {
		if ($request->ajax()) {
			$data = Absensi::all();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('nik', function($data) {
				return $data->nik .' - '. $data->pegawai->full_name;
			})
			->editColumn('date_time', function($data) {
				return date('d-M-Y H:i:s', strtotime($data->date_time));
			})
			->editColumn('in_out', function($data) {
				if ($data->in_out == 1) {
					return '<div class="label bg-green">In</div>';
				} else {
					return '<div class="label bg-red">Out</div>';
				}
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function export() 
	{
		return Excel::download(new AbsensiExport, 'Data Absensi '. date('YmdHis') .'.csv', \Maatwebsite\Excel\Excel::CSV, [
			'Content-Type' => 'text/csv',
		]);
	}
}
