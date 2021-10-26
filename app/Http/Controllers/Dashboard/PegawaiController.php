<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use DataTables;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller {
	public function index() {
		return view('dashboard.pegawai.index', ['page_title' => 'Pegawai', 'active_menu' => 'pegawai']);
	}

	public function getPegawai(Request $request) {
		if ($request->ajax()) {
			$data = Pegawai::select('id','nik','full_name','email','mobile_number');
			return Datatables::of($data)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '<button class="btn btn-info btn-xs" data-id="'.$data->id.'" data-toggle="modal" data-target="#mdlView" title="Detail"><i class="fa fa-eye"></i></button> <a href="'.route('dashboard.pegawai.edit',$data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <form method="POST" onsubmit="return confirm(\'Hapus '.$data->full_name.' ?\')" action="'.route('dashboard.pegawai.destroy', $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>';
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function create() {
		return view('dashboard.pegawai.create', ['page_title' => 'Pegawai - Tambah Data', 'active_menu' => 'pegawai']);
	}

	public function store(Request $request) {
		$request->validate([
			'nik' => 'required|unique:pegawais,nik',
			'full_name' => 'required',
			'email' => 'required|email|unique:pegawais,email',
			'mobile_number' => 'required|unique:pegawais,mobile_number',
			'address' => 'required',
		]);
    	// dd($request->all());

		$pegawai = new Pegawai;
		$pegawai->nik = trim($request->nik);
		$pegawai->full_name = trim($request->full_name);
		$pegawai->email = trim($request->email);
		$pegawai->mobile_number = trim($request->mobile_number);
		$pegawai->address = $request->address;
		$pegawai->save();
		return redirect('dashboard/pegawai')->with('notification', $this->flash_data('success', 'Berhasil', 'Pegawai Berhasil Ditambahkan'));
	}

	public function show(Request $request, $id) {
		if ($request->ajax()) {
			$pegawai = Pegawai::findOrFail($id);
			$html = '';
			$html .= '<div class="table-responsive">';
			$html .= '<table class="table table-hover">';
			$html .= '<tr>';
			$html .= '<th>NIK</th>';
			$html .= '<td>: '.$pegawai->nik.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<th>Nama</th>';
			$html .= '<td>: '.$pegawai->full_name.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<th>Email</th>';
			$html .= '<td>: '.$pegawai->email.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<th>No. Handphone</th>';
			$html .= '<td>: '.$pegawai->mobile_number.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<th>Alamat</th>';
			$html .= '<td>: '.$pegawai->address.'</td>';
			$html .= '</tr>';
			$html .= '</table>';
			$html .= '</div>';
			return $html;
		}
	}

	public function edit($id) {
		$pegawai = Pegawai::findOrFail($id);
		return view('dashboard.pegawai.edit',['pegawai' => $pegawai, 'page_title' => 'Pegawai - Edit Data', 'active_menu' => 'pegawai']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'nik' => 'required|unique:pegawais,nik,'.$id,
			'full_name' => 'required',
			'email' => 'required|email|unique:pegawais,email,'.$id,
			'mobile_number' => 'required|unique:pegawais,mobile_number,'.$id,
			'address' => 'required',
		]);

		$pegawai = Pegawai::findOrFail($id);
		$pegawai->nik = trim($request->nik);
		$pegawai->full_name = trim($request->full_name);
		$pegawai->email = trim($request->email);
		$pegawai->mobile_number = trim($request->mobile_number);
		$pegawai->address = $request->address;
		$pegawai->save();
		return redirect('dashboard/pegawai')->with('notification', $this->flash_data('success', 'Berhasil', 'Pegawai Berhasil Diupdate'));
	}

	public function destroy($id) {
		$pegawai = Pegawai::findOrFail($id);
		$pegawai->delete();
		return redirect('dashboard/pegawai')->with('notification', $this->flash_data('success', 'Berhasil', 'Pegawai Berhasil Dihapus'));
	}

	public function export() 
	{
		// return Excel::download(new PegawaiExport, 'Data Pegawai '. date('YmdHis') .'.csv');

		return Excel::download(new PegawaiExport, 'Data Pegawai '. date('YmdHis') .'.csv', \Maatwebsite\Excel\Excel::CSV, [
			'Content-Type' => 'text/csv',
		]);
		// return (new PegawaiExport)->download('Data Pegawai '. date('YmdHis') .'.csv', \Maatwebsite\Excel\Excel::CSV);
		// return (new PegawaiExport)->download('Data Pegawai '. date('YmdHis') .'.csv', \Maatwebsite\Excel\Excel::CSV, [
		// 	'Content-Type' => 'text/csv',
		// ]);
	}
}
