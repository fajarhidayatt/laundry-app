<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $outlets = Outlet::with('user')->get();

        return view('admin.outlet.index', [
            'title' => 'outlet',
            'data' => $outlets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.outlet.create', [
            'title' => 'outlet',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Outlet::create($data);

        return redirect()->route('outlet.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $outlet = Outlet::with('user')->find($id);
        $users = User::with('outlet')->where('role', 'owner')->get();

        // dd($users);

        return view('admin.outlet.edit', [
            'title' => 'outlet',
            'outlet' => $outlet,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $outlet = Outlet::find($id);

        // mengganti owner lama dengan owner baru
        if ($request->owner_id_new) {
            // mengganti outlet_id pada owner lama menjadi null
            $oldOwner = User::find($outlet->user->id);
            $oldOwner->update(['outlet_id' => null]);

            // mengganti outlet_id pada owner baru menjadi outlet yang dipilih
            $newOwner = User::find($request->owner_id_new);
            $newOwner->update(['outlet_id' => $outlet->id]);
        } else {
            // mengganti outlet_id pada user menjadi outlet yang dipilih
            $user = User::find($request->owner_id);
            $user->update(['outlet_id' => $outlet->id]);
        }

        $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number
        ]);

        return redirect()->route('outlet.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $outlet = Outlet::find($id);

        $outlet->delete();

        return redirect()->route('outlet.index');
    }
}
