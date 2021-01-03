<?php

namespace App\Exports;

use App\Pinjaman;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PinjamanExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('ketua.report.pinjaman_excel', [
            'pinjaman' => Pinjaman::orderBy('created_at')->get()
        ]);
    }
}
