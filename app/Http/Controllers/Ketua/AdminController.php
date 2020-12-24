<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\{Storage, Hash};
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ketua.user.index', ['users' => User::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ketua.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'image'                 => 'required|image|mimes:jpg,png,jpeg,bmp',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
            'roles'                 => 'nullable|string|in:admin,ketua'
        ]);

        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/user', 'public');
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('admin.index')
            ->with(['status' => 'Data User Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ketua.user.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email,' . $id,
            'image'                 => 'nullable|image|mimes:jpg,png,jpeg,bmp',
            'password'              => 'sometimes|nullable|min:3',
            'konfirmasi_password'   => 'sometimes|same:password|nullable|min:3',
            'roles'                 => 'nullable|string|in:admin,ketua'
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(storage_path('app/public/' . $user->image))) {
                Storage::delete('public/' . $user->image);
                $data['image'] =  $request->file('image')->store('assets/user', 'public');
            } else {
                $data['image'] =  $request->file('image')->store('assets/user', 'public');
            }
        }

        if ($request->input('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $user->update($data);
        return redirect()->route('admin.index')->with(['success' => 'Data User' . $user->name . 'Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::delete('public/' . $user->image);
        $user->delete();
        return redirect()->route('admin.index')->with(['success' => 'Data User' . $user->name . 'Berhasil Dihapus']);
    }
}
