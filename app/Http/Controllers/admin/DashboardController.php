<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $outletTotal = Outlet::all()->count();
        $memberTotal = Member::all()->count();
        $transactionTotal = Transaction::all()->count();

        return view('admin.index', [
            'outletTotal' => $outletTotal,
            'memberTotal' => $memberTotal,
            'transactionTotal' => $transactionTotal,
        ]);
    }
}
