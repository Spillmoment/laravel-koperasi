<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rules\UserOldPassword;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function profile()
    {
        return view('admin.dashboard.profile');
    }

    public function update_profile(Request $request,User $user)
    {
        $request->validate([
            'name'  => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // if ($request->hasFile('gambar_unit')) {
        //     if ($request->file('gambar_unit')) {
        //         if ($user->gambar_unit && file_exists(storage_path('app/public/' . $user->gambar_unit))) {
        //             Storage::delete('public/' . $user->gambar_unit);
        //             $file = $request->file('gambar_unit')->store('unit', 'public');
        //             $data['gambar_unit'] = $file;
        //         } else {
        //             $file = $request->file('gambar_unit')->store('unit', 'public');
        //             $data['gambar_unit'] = $file;
        //         }
        //     }
        // }
        $data = $request->all();
        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Profile Berhasil Disimpan'
        ]);
    }
    
    public function pengaturan()
    {
        return view('admin.dashboard.pengaturan');
    }

    public function update_pengaturan(Request $request, User $user)
    {
        $request->validate([
            'current_password' => ['required', new UserOldPassword],
            'password' => ['required', 'min:3'],
            'konfirmasi_password' => ['same:password'],
        ]);

        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with(['success' => 'Password berhasil diupdate!']);
    }

}
