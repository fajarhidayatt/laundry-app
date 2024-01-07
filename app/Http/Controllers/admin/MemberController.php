<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return view('admin.member.index', [
            'members' => $members
        ]);
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Member::create($data);

        return redirect()->route('admin.member.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil tambah data pelanggan',
            'type' => 'success'
        ]);
    }

    public function edit(string $id)
    {
        $member = Member::find($id);

        return view('admin.member.edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $member = Member::find($id);

        $member->update($data);

        return redirect()->route('admin.member.index')->with([
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

        return redirect()->route('admin.member.index')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus data pelanggan',
            'type' => 'success'
        ]);
    }
}
