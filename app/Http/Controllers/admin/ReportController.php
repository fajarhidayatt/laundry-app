<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
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

        $transactions = DB::table('transactions')
            ->select(
                DB::raw('SUM(detail_transactions.total_price) AS income'),
                DB::raw('COUNT(transactions.id) AS total'),
                'outlets.name AS outlet_name',
                'users.name AS owner_name'
            )
            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->join('outlets', 'transactions.outlet_id', '=', 'outlets.id')
            ->join('users', 'outlets.id', '=', 'users.outlet_id')
            ->where('transactions.payment_status', '=', 'lunas')
            ->where('users.role', '=', 'owner')
            ->groupBy('transactions.outlet_id')
            ->get();

        return view('admin.report.index', [
            'annualIncome' => $annualIncome,
            'monthlyIncome' => $monthlyIncome,
            'weeklyIncome' => $weeklyIncome,
            'transactions' => $transactions
        ]);
    }
}
