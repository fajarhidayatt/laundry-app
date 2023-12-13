@extends('cashier.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pembayaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Transaksi</a></li>
                <li><a href="#">Pembayaran</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                          <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="/cashier/transaction/{{ $transaction->id }}" id="form-submit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="invoice">Kode Invoice</label>
                        <input type="text" name="invoice" id="invoice" value="{{ $transaction->invoice }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="member_name">Nama Member</label>
                        <input type="text" name="member_name" id="member_name" value="Jhon" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Yang Harus Di Bayar</label>
                        <input type="text" name="total_price" id="total_price" value="35000" class="form-control" readonly>
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