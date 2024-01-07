<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::with('owner')->get();

        return view('admin.outlet.index', [
            'outlets' => $outlets
        ]);
    }

    public function create()
    {
        return view('admin.outlet.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Outlet::create($data);

        return redirect()->route('admin.outlet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil tambah data outlet',
            'type' => 'success'
        ]);
    }

    public function edit(string $id)
    {
        $outlet = Outlet::with('owner')->find($id);
        $users = User::with('outlet')->where('role', 'owner')->get(); /// hanya mengambil user dengan role `owner`

        return view('admin.outlet.edit', [
            'outlet' => $outlet,
            'users' => $users
        ]);
    }

    public function update(Request $request, string $id)
    {
        $outlet = Outlet::find($id);

        if ($request->owner_id_new) { /// jika mengganti owner lama dengan owner baru
            $oldOwner = User::find($outlet->owner->id);
            $oldOwner->update([
                'outlet_id' => null,
            ]); /// mengganti `outlet_id` pada owner lama menjadi `null`

            $newOwner = User::find($request->owner_id_new);
            $newOwner->update([
                'outlet_id' => $outlet->id,
            ]); /// mengganti `outlet_id` pada owner baru menjadi outlet yang dipilih
        } else if ($request->owner_id) {
            $user = User::find($request->owner_id);
            $user->update([
                'outlet_id' => $outlet->id,
            ]); /// mengganti `outlet_id` pada user menjadi outlet yang dipilih
        }

        $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number
        ]);

        return redirect()->route('admin.outlet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil ubah data outlet',
            'type' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $outlet = Outlet::find($id);

        $outlet->delete();

        return redirect()->route('admin.outlet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus data outlet',
            'type' => 'success'
        ]);
    }
}
