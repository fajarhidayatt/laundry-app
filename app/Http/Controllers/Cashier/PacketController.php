<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Packet;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packets = Packet::all();

        return view('cashier.packet.index', [
            'packets' => $packets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $outlets = Outlet::all();

        return view('cashier.packet.create', [
            'outlets' => $outlets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Packet::create($data);

        return redirect('cashier/packet');
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
        $packet = Packet::find($id);
        $outlets = Outlet::all();

        return view('cashier.packet.edit', [
            'packet' => $packet,
            'outlets' => $outlets
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $packet = Packet::find($id);

        $packet->update($data);

        return redirect('/cashier/packet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $packet = Packet::find($id);

        $packet->delete();

        return redirect('/cashier/packet');
    }
}
