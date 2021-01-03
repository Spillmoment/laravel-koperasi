<?php

namespace App\Exports;

use App\Simpanan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SimpananExports implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('ketua.report.simpanan_excel', [
            'simpanan' => Simpanan::orderBy('created_at')->get()
        ]);
    }
}
