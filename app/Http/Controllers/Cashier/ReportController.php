<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $annualIncome = Transaction::with('detailTransaction')
            ->where('payment_status', 'lunas')
            ->whereYear('payment_date', Carbon::now()->year)
            ->get()
            ->sum(function ($transaction) {
                return $transaction->detailTransaction->total_price;
            });

        $monthlyIncome = Transaction::with('detailTransaction')
            ->where('payment_status', 'lunas')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->get()
            ->sum(function ($transaction) {
                return $transaction->detailTransaction->total_price;
            });

        $weeklyIncome = Transaction::with('detailTransaction')
            ->where('payment_status', 'lunas')
            ->whereBetween('payment_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->sum(function ($transaction) {
                return $transaction->detailTransaction->total_price;
            });

        $transactions = DB::table('detail_transactions')
            ->select(
                DB::raw('SUM(detail_transactions.total_price) AS income'),
                DB::raw('COUNT(detail_transactions.packet_id) AS total'),
                'packets.name AS packet_name',
                'packets.price AS packet_price',
            )
            ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->join('packets', 'packets.id', '=', 'detail_transactions.packet_id')
            ->where('transactions.payment_status', '=', 'lunas')
            ->where('packets.outlet_id', '=', Auth::user()->outlet_id)
            ->groupBy('detail_transactions.packet_id')
            ->get();

        return view('cashier.report.index', [
            'annualIncome' => $annualIncome,
            'monthlyIncome' => $monthlyIncome,
            'weeklyIncome' => $weeklyIncome,
            'transactions' => $transactions
        ]);
    }
}
