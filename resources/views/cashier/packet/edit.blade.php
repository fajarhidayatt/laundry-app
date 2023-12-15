@extends('cashier.partials.main')

@section('content')
    <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Paket</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <span>Paket</span>
                </li>
                <li>
                    <span>Edit Paket</span>
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
                <form action="/cashier/packet/{{ $packet->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Paket</label>
                        <input type="text" name="name" id="name" class="form-control" required value="{{ $packet->name }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis Paket</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="{{ $packet->type }}" hidden selected>{{ ucfirst($packet->type) }}</option>
                            <option value="kiloan">Kiloan</option>
                            <option value="selimut">Selimut</option>
                            <option value="bedcover">Bedcover</option>
                            <option value="kaos">Kaos</option>
                            <option value="lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" required value="{{ $packet->price }}">
                    </div>
                    <div class="form-group">
                        <label for="outlet_name">Outlet</label>
                        <input type="text" name="outlet_name" id="outlet_name" class="form-control" disabled value="{{ $packet->outlet->name }}">
                        <input type="text" name="outlet_id" id="outlet_id" class="form-control" readonly value={{ $packet->outlet_id }} style="display: none;">
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