@extends('cashier.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Transaki</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <span>Transaksi</span>
                </li>
                <li>
                    <span>Pilih Pelanggan</span>
                </li>
                <li>
                    <span>Tambah Transaksi</span>
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
                <form action="/cashier/transaction" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="invoice">Kode Invoice</label>
                        <input type="text" name="invoice" id="invoice" class="form-control" value="{{ $invoice }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="outlet_name">Outlet</label>
                        <input type="text" name="outlet_id" value="{{ $outlet->id }}" hidden readonly>
                        <input type="text" name="outlet_name" id="outlet_name" class="form-control" value="{{ $outlet->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="member_name">Pelanggan</label>
                        <input type="text" name="member_id" value="{{ $member->id }}" hidden readonly>
                        <input type="text" name="member_name" class="form-control" value="{{ $member->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="packet_id">Pilih Paket</label>
                        <select name="packet_id" class="form-control" required>
                            @foreach ($packets as $packet)
                                <option value="{{ $packet->id }}">{{ $packet->name }} (Rp. {{ number_format($packet->price, 0, ",", ".") }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Jumlah</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="additional_cost">Biaya Tambahan (Rp.)</label>
                        <input type="number" name="additional_cost" id="additional_cost" class="form-control" value="0">
                    </div>
                    <div class="form-group">
                        <label for="discount">Diskon (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control" value="0">
                    </div>
                    <div class="form-group">
                        <label for="tax">Pajak (%)</label>
                        <input type="number" name="tax" id="tax" class="form-control" value="0">
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection