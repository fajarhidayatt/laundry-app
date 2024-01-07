@extends('partials.main')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pembayaran</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li>
                        <span>Transaksi</span>
                    </li>
                    <li>
                        <span>Konfirmasi Pembayaran</span>
                    </li>
                    <li>
                        <span>Pembayaran</span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title">
                                <i class="fa fa-arrow-left fa-fw"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data">
                                <i class="fa fa-refresh" id="ic-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <form method="post" action="{{ route('cashier.transaction.deal', $transaction->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="invoice">Kode Invoice</label>
                            <input
                                type="text"
                                name="invoice"
                                id="invoice"
                                class="form-control"
                                value="{{ $transaction->invoice }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="member_name">Nama Member</label>
                            <input
                                type="text"
                                name="member_name"
                                id="member_name"
                                class="form-control"
                                value="{{ $transaction->member->name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_price">Total Yang Harus Di Bayar</label>
                            <input
                                type="text"
                                name="total_price"
                                id="total_price"
                                class="form-control"
                                value="{{ $transaction->detailTransaction->total_price }}"
                                readonly
                                style="display: none;">
                            <input
                                type="text"
                                class="form-control"
                                value="Rp. {{ number_format($transaction->detailTransaction->total_price, 0, ',', '.') }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="total_payment">Masukan Jumlah Pembayaran</label>
                            <input type="number" name="total_payment" id="total_payment" class="form-control">
                        </div>
                        <div class="text-right">
                            <button type="submit" name="btn-simpan" id="btn-simpan" class="btn btn-primary">Bayar</utton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
