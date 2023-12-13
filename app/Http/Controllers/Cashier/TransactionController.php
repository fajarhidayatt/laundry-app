<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Packet;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('cashier.transaction.index', [
            'transactions' => $transactions
        ]);
    }

    public function find()
    {
        $members = Member::all();

        return view('cashier.transaction.find', [
            'members' => $members
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $memberId)
    {
        $outlet_id = 4;

        $invoice = 'DRY' . Carbon::now()->format('Ymdsi');
        $outlet = Outlet::find($outlet_id);
        $member = Member::find($memberId);
        $packets = Packet::where('outlet_id', $outlet_id)->get();

        // dd($invoice);

        return view('cashier.transaction.create', [
            'invoice' => $invoice,
            'outlet' => $outlet,
            'member' => $member,
            'packets' => $packets
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = 3;
        $date = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $timeLimit = Carbon::now('Asia/Jakarta')->addWeek(1)->toDateTimeString();

        $transaction = Transaction::create([
            'outlet_id' => $request->outlet_id,
            'invoice' => $request->invoice,
            'member_id' => $request->member_id,
            'date' => $date,
            'time_limit' => $timeLimit,
            'additional_cost' => $request->additional_cost,
            'discount' => $request->discount,
            'tax' => $request->tax,
            'status' => 'baru',
            'payment_status' => 'belum',
            'user_id' => $userId,
        ]);

        $packet = Packet::find($request->packet_id);
        $totalPrice = $packet->price * $request->qty + $request->additional_cost;

        DetailTransaction::create([
            'transaction_id' => $transaction->id,
            'packet_id' => $request->packet_id,
            'qty' => $request->qty,
            'total_price' => $totalPrice,
        ]);

        return redirect("/cashier/transaction/$transaction->id/success");
    }

    public function success($id)
    {
        $transaction = Transaction::find($id);

        return view('cashier.transaction.success', [
            'transaction' => $transaction
        ]);
    }

    public function confirmation()
    {
        $transactions = Transaction::all();

        return view('cashier.transaction.confirmation', [
            'transactions' => $transactions
        ]);
    }

    public function payment(string $id)
    {
        $transaction = Transaction::find($id);

        return view('cashier.transaction.payment', [
            'transaction' => $transaction
        ]);
    }

    public function deal(Request $request, string $id)
    {
        // dd($request->all());
        $paymentDate = Carbon::now('asia/jakarta')->toDateTimeString();

        // dd($detailTransaction);

        if ($request->total_payment < $request->total_price) {
            return redirect("/cashier/transaction/$id/payment");
        }

        $transaction = Transaction::find($id);
        $transaction->update(['payment_date' => $paymentDate]);

        $detailTransaction = detailTransaction::where('transaction_id', $id)->first();
        $detailTransaction->update(['total_payment' => $request->total_payment]);

        return redirect("/cashier/transaction/$id/done");
    }

    public function done(string $id)
    {
        $transaction = Transaction::find($id);

        return view('cashier.transaction.done', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::find($id);

        return view('cashier.transaction.show', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
