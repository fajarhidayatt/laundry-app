@extends('cashier.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Transaksi</a></li>
                <li><a href="#">Detail Transaksi</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Kode Invoice</label>
                        <input type="text" class="form-control" value="{{ $transaction->invoice }}">
                    </div>
                    <div class="form-group">
                        <label>Outlet</label>
                        <input type="text" class="form-control" value="{{ $transaction->outlet_id }}">
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" class="form-control" value="{{ $transaction->member_id }}">
                    </div>
                    <div class="form-group">
                        <label>Jenis Paket</label>
                        <input type="text" class="form-control" value="{{ 'Kiloan' }}">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" value="{{ 12 }}">
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <input type="text" class="form-control" value="{{ 10 }}">
                    </div>
                    {{-- <?php if ($data['total_bayar'] > 0) : ?>
                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="text" class="form-control" value="{{  }}">
                        </div>
                        <div class="form-group">
                            <label>Di Bayar Pada Tanggal </label>
                            <input type="text" class="form-control" value="<?= $data['tgl_pembayaran'] ?>">
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label>Total Bayar</label>
                            <input type="text" class="form-control" value="Belum Melakukan Pembayaran">
                        </div>
                        <div class="form-group">
                            <label>Batas Waktu Pembayaran</label>
                            <input type="text" class="form-control" value="<?= $data['batas_waktu'] ?>">
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Status Transaksi</label>
                        <select name="status" class="form-control" <?php if ($data['status'] == 'diambil') : ?> readonly='' disabled <?php endif; ?>>
                            <?php foreach ($status as $key) : ?>
                                <?php if ($key == $data['status']) : ?>
                                    <option value="<?= $key ?>" selected><?= $key ?></option>
                                <?php endif ?>
                                <option value="<?= $key ?>"><?= $key ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?php if ($data['status'] == 'diambil') { ?>
                        <small>Transaksi telah selesai <i class="fa fa-check fa-fw"></i></small>
                        <div class="text-right">
                            <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"> OK</a>
                        </div>
                    <?php } else { ?>
                        <div class="text-right">
                            <button type="submit" name="btn-simpan" class="btn btn-primary">Ubah</button>
                        </div>
                    <?php } ?> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection