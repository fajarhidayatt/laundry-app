@extends('admin.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Oulet</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-success"></i>
                        <span class="counter text-success">{{ $outletTotal }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Pelanggan</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-purple"></i>
                        <span class="counter text-purple">{{ $memberTotal }}</span>
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
</div>
@endsection