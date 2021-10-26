<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PegawaiExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.pegawai.export', [
            'pegawai' => Pegawai::select('nik','full_name','email','mobile_number','address')->get()
        ]);
    }
}
