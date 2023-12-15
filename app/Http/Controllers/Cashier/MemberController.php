<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return view('cashier.member.index', [
            'members' => $members
        ]);
    }

    public function create()
    {
        return view('cashier.member.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Member::create($data);

        return redirect('/cashier/member')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil tambah data pelanggan',
            'type' => 'success'
        ]);
    }

    public function edit(string $id)
    {
        $member = Member::find($id);

        return view('cashier.member.edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $member = Member::find($id);

        $member->update($data);

        return redirect('/cashier/member')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil ubah data pelanggan',
            'type' => 'success'
        ]);
    }

    public function destroy(string $id)
    {
        $member = Member::find($id);

        $member->delete();

        return redirect('/cashier/member')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus data pelanggan',
            'type' => 'success'
        ]);
    }
}
