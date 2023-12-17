<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Packet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $outletId = Auth::user()->outlet_id;

        $outletName = Outlet::find($outletId)->name;
        $packetTotal = Packet::all()
            ->where('outlet_id', $outletId)
            ->count();
        $transactionTotal = Transaction::all()
            ->where('outlet_id', $outletId)
            ->count();
        $cashierTotal = User::all()
            ->where('outlet_id', $outletId)
            ->where('role', 'kasir')
            ->count();

        $transactions = Transaction::with(['member', 'detailTransaction'])
            ->where('outlet_id', $outletId)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        // dd($transactions);

        return view('owner.index', [
            'outletName' => $outletName,
            'packetTotal' => $packetTotal,
            'transactionTotal' => $transactionTotal,
            'cashierTotal' => $cashierTotal,
            'transactions' => $transactions,
        ]);
    }
}
