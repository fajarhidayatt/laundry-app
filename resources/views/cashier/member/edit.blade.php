@extends('cashier.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Pelanggan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Pelanggan</a></li>
                <li><a href="#">Tambah Pelanggan</a></li>
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
                <form method="post" action="{{ route('member.update', $member->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" name="nik" id="nik" value="{{ $member->nik }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $member->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" id="address" value="{{ $member->address }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ $member->phone_number }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="L" {{ $member->gender === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $member->gender === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
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