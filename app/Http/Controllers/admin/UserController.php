<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $outlets = Outlet::all();

        return view('admin.user.create', [
            'outlets' => $outlets
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        User::create($data);

        return redirect()->route('admin.user.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil tambah data user',
            'type' => 'success'
        ]);
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $outlets = Outlet::all();

        return view('admin.user.edit', [
            'user' => $user,
            'outlets' => $outlets
        ]);
    }

    public function update(Request $request, string $id)
    {

        $data = $request->all();
        $user = User::find($id);

        /// cara lain untuk meng-update data, menggunakan method `save()`
        $user['name'] = $data['name'];
        $user['username'] = $data['username'];
        $user['role'] = $data['role'];
        $user['outlet_id'] = $data['outlet_id'] ?? null;

        if ($data['password']) {
            $user['password'] = $data['password'];
        }

        $user->save();

        return redirect()->route('admin.user.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil ubah data user',
            'type' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.user.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus data user',
            'type' => 'success'
        ]);
    }
}
