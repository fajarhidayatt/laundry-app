@extends('partials.main')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Konfirmasi Pembayaran</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li>
                        <span>Transaksi</span>
                    </li>
                    <li>
                        <span>Konfirmasi Pembayaran</span>
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
                    <div class="table-responsive">
                        <table class="table table-bordered thead-dark" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->invoice }}</td>
                                        <td>{{ $transaction->member->name }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>
                                            Rp.
                                            {{ number_format($transaction->detailTransaction->total_price, 0, ',', '.') }}
                                        </td>
                                        <td align="center">
                                            <a
                                                href="{{ route('cashier.transaction.payment', $transaction->id) }}"
                                                data-toggle="tooltip"
                                                data-placement="bottom"
                                                title="Pilih"
                                                class="btn btn-primary btn-block">
                                                Pilih
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
