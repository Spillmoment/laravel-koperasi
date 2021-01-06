<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjaman;
use App\Simpanan;
use App\Anggota;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pinjaman' => Pinjaman::all()->count(),
            'simpanan' => Simpanan::all()->count(),
            'anggota'  => Anggota::all()->count(),
            'user'     => User::all()->count(),
        ];

        return view('ketua.dashboard.index', $data);
    }
}
