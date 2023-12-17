<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function detail(string $id)
    {
        $transaction = Transaction::with(['member', 'user', 'outlet', 'detailTransaction'])->find($id);

        return view('owner.transaction', [
            'transaction' => $transaction
        ]);
    }
}
