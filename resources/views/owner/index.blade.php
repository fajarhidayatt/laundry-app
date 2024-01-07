@extends('partials.main')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $outletName }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Paket</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <div id="sparklinedash"></div>
                        </li>
                        <li class="text-right">
                            <i class="ti-arrow-up text-success"></i>
                            <span class="counter text-success">{{ $packetTotal }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Kasir</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <div id="sparklinedash2"></div>
                        </li>
                        <li class="text-right">
                            <i class="ti-arrow-up text-purple"></i>
                            <span class="counter text-purple">{{ $cashierTotal }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Transaksi</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <div id="sparklinedash3"></div>
                        </li>
                        <li class="text-right">
                            <i class="ti-arrow-up text-info"></i>
                            <span class="counter text-info">{{ $transactionTotal }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">10 Transaksi Terbaru</h3>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Member</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
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
                                        <td>{{ $transaction->payment_status }}</td>
                                        <td>{{ $transaction->detailTransaction->total_price }}</td>
                                        <td align="center">
                                            <a href="{{ route('owner.transaction.detail', $transaction->id) }}"
                                                data-toggle="tooltip" data-placement="bottom" title="Detail"
                                                class="btn btn-success btn-block">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada transaksi</td>
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
