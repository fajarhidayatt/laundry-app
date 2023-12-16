@extends('cashier.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <span>Transaksi</span>
                </li>
                <li>
                    <span>Detail Transaksi</span>
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form action="/cashier/transaction/{{ $transaction->id }}/status" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Kode Invoice</label>
                        <input type="text" class="form-control" value="{{ $transaction->invoice }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Outlet</label>
                        <input type="text" class="form-control" value="{{ $transaction->outlet->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Kasir</label>
                        <input type="text" class="form-control" value="{{ $transaction->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" class="form-control" value="{{ $transaction->member->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Jenis Paket</label>
                        <input type="text" class="form-control" value="{{ $transaction->detailTransaction->packet->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" value="{{ $transaction->detailTransaction->qty }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" class="form-control" value="Rp. {{ number_format($transaction->detailTransaction->total_price, 0, ",", ".") }}" disabled>
                    </div>
                    @if ($transaction->payment_status === 'lunas')
                        <div class="form-group">
                            <label>Uang Bayar</label>
                            <input type="text" class="form-control" value="Rp. {{ number_format($transaction->detailTransaction->total_payment, 0, ",", ".") }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembayaran</label>
                            <input type="text" class="form-control" value="{{ $transaction->payment_date }}" disabled>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Uang Bayar</label>
                            <input type="text" class="form-control" value="Belum melakukan pembayaran" disabled>
                        </div>
                        <div class="form-group">
                            <label>Batas Waktu Pembayaran</label>
                            <input type="text" class="form-control" value="Rp. {{ number_format($transaction->time_limit, 0, ",", ".") }}" disabled>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="status">Status Transaksi</label>
                        <select name="status" id="status" class="form-control" {{ $transaction->status === 'diambil' ? 'disabled' : '' }}>
                            <option value="{{ $transaction->status }}" selected hidden>{{ $transaction->status }}</option>
                            <option value="baru">baru</option>
                            <option value="proses">proses</option>
                            <option value="selesai">selesai</option>
                            <option value="diambil" {{ $transaction->payment_status !== 'lunas' ? 'disabled' : '' }}>diambil</option>
                        </select>
                    </div>
                    @if ($transaction->status === 'diambil')
                        <small>Transaksi telah selesai <i class="fa fa-check fa-fw"></i></small>
                        <div class="text-right">
                            <a href="javascript:void(0)" class="btn btn-primary box-title" onclick="window.history.back();">OK</a>
                        </div>
                    @else
                        <div class="text-right">
                            <button type="submit" name="btn-simpan" class="btn btn-primary">Ubah</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection