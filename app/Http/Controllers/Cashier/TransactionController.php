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
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['member', 'detailTransaction'])->get();

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

    public function create(string $memberId)
    {
        $outletId = Auth::user()->outlet_id;

        $invoice = 'DRY' . Carbon::now()->format('Ymdsi'); /// generate kode `invoice`
        $outlet = Outlet::find($outletId); /// ambil data outlet berdasarkan `outlet_id` kasir
        $member = Member::find($memberId); /// ambil data member berdasarkan yang dipilih
        $packets = Packet::where('outlet_id', $outletId)->get(); /// ambil data paket berdasarkan `outlet_id`

        return view('cashier.transaction.create', [
            'invoice' => $invoice,
            'outlet' => $outlet,
            'member' => $member,
            'packets' => $packets
        ]);
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $date = Carbon::now('Asia/Jakarta')->toDateTimeString(); /// dapatkan tanggal dan waktu sekarang
        $timeLimit = Carbon::now('Asia/Jakarta')->addWeek(1)->toDateTimeString(); /// masa kadaluarsa ditambah 1 minggu

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

        $getTotalPrice = $packet->price * $request->qty + $request->additional_cost; /// harga_paket * qty + biaya_tambahan
        $getDiscount = $getTotalPrice * ($request->discount / 100); /// total_harga * (diskon / 100)
        $getTax = $getTotalPrice * ($request->tax / 100); /// total_harga * (pajak / 100)

        $totalPrice = $getTotalPrice - $getDiscount + $getTax; /// total_harga - diskon + pajak

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
        $transaction = Transaction::with(['member', 'detailTransaction'])->find($id);

        return view('cashier.transaction.success', [
            'transaction' => $transaction
        ]);
    }

    public function confirmation()
    {
        $transactions = Transaction::with(['member', 'detailTransaction'])
            ->where('payment_status', 'belum')
            ->get();

        return view('cashier.transaction.confirmation', [
            'transactions' => $transactions
        ]);
    }

    public function payment(string $id)
    {
        $transaction = Transaction::with(['member', 'detailTransaction'])
            ->find($id);

        return view('cashier.transaction.payment', [
            'transaction' => $transaction
        ]);
    }

    public function deal(Request $request, string $id)
    {
        $paymentDate = Carbon::now('asia/jakarta')->toDateTimeString();

        if ($request->total_payment < $request->total_price) {
            return redirect("/cashier/transaction/$id/payment")->with([
                'alert' => true,
                'title' => 'Gagal',
                'message' => 'Jumlah uang pembayaran kurang',
                'type' => 'error'
            ]);
        }

        $transaction = Transaction::find($id);
        $transaction->update([
            'payment_date' => $paymentDate,
            'payment_status' => 'lunas',
        ]); /// update status pembayaran dan tanggal pembayaran

        $detailTransaction = detailTransaction::where('transaction_id', $id)->first();
        $detailTransaction->update([
            'total_payment' => $request->total_payment,
        ]); /// update jumlah pembayaran

        return redirect("/cashier/transaction/$id/done");
    }

    public function done(string $id)
    {
        $transaction = Transaction::with(['member', 'detailTransaction'])->find($id);

        return view('cashier.transaction.done', [
            'transaction' => $transaction
        ]);
    }

    public function show(string $id)
    {
        $transaction = Transaction::with(['member', 'outlet', 'detailTransaction'])->find($id);

        return view('cashier.transaction.show', [
            'transaction' => $transaction
        ]);
    }

    public function updateStatus(Request $request, string $id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'status' => $request->status,
        ]); /// update status transaksi

        return redirect('/cashier/transaction')->with([
            'alert' => true,
            'title' => 'Berhasil',
            'message' => 'Berhasil update status transaksi',
            'type' => 'success'
        ]);
    }
}
