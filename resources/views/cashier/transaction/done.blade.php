@extends('partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Transaski Dibayar</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center" style="padding-left: 50px;padding-right: 50px;">
                        <div class="bg-success" style="font-size: 125px;border-radius: 20px">
                            <i class="fa fa-check fa-10x text-white"></i>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Pesanan Atas Nama <strong>{{ $transaction->member->name }}</strong> Berhasil Di Bayar</h3>
                        <strong>Kode Invoice {{ $transaction->invoice }}</strong><br>
                        <strong>Total Harga Rp. {{ number_format($transaction->detailTransaction->total_price, 0, ",", ".") }}</strong><br>
                        <strong>Uang Bayar Rp. {{ number_format($transaction->detailTransaction->total_payment, 0, ",", ".") }}</strong><br>
                        <strong>Kembalian Rp. {{ number_format($transaction->detailTransaction->total_payment - $transaction->detailTransaction->total_price, 0, ",", ".") }}</strong><br><br>
                        <a href="/cashier/transaction" class="btn btn-primary">Kembali Ke Menu Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection