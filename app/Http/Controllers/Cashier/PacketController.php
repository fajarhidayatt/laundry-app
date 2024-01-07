<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacketController extends Controller
{
    public function index()
    {
        $outletId = Auth::user()->outlet_id;
        $packets = Packet::all()->where('outlet_id', $outletId);

        return view('cashier.packet.index', [
            'packets' => $packets
        ]);
    }

    public function create()
    {
        $outletId = Auth::user()->outlet_id;
        $outlet = Outlet::find($outletId);

        return view('cashier.packet.create', [
            'outlet' => $outlet
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Packet::create($data);

        return redirect()->route('cashier.packet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil tambah data paket',
            'type' => 'success'
        ]);
    }

    public function edit(string $id)
    {
        $packet = Packet::with('outlet')->find($id);

        return view('cashier.packet.edit', [
            'packet' => $packet,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $packet = Packet::find($id);

        $packet->update($data);

        return redirect()->route('cashier.packet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil ubah data paket',
            'type' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $packet = Packet::find($id);

        $packet->delete();

        return redirect()->route('cashier.packet.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus data paket',
            'type' => 'success'
        ]);
    }
}
