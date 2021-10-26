<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller {
	public function index() {
		return view('index');
	}

	public function absen(Request $request) {
		$validator = Validator::make($request->all(), ['nik' => 'required']);

		if ($validator->fails()) {
			return response()->json(["success" => false, 'message' => 'Harap masukkan NIK pegawai']);
		}

		$pegawai = DB::table('pegawais')->leftJoin('absensis', 'pegawais.nik', '=', 'absensis.nik')->select('pegawais.full_name','absensis.*')->where('pegawais.nik', $request->nik)->orderBy('absensis.id', 'DESC')->first();
		if (!$pegawai) {
			return response()->json(["success" => false, 'message' => 'NIK tidak terdaftar']);
		}

		$absensi = new Absensi;
		if ($pegawai->id == '') {
			$in_out = 1;
			$message = $pegawai->full_name . ' berhasil absen masuk';
		} else {
			if ($pegawai->in_out == 0) {
				$in_out = 1;
				$message = $pegawai->full_name . ' berhasil absen masuk';
			} else {
				$in_out = 0;
				$message = $pegawai->full_name . ' berhasil absen keluar';
			}
		}

		$absensi->nik = $request->nik;
		$absensi->date_time = date('Y-m-d H:i:s');
		$absensi->in_out = $in_out;
		$absensi->save();
		return response()->json(["success" => true, 'message' => $message]);
	}
}
