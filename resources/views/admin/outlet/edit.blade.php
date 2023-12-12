@extends('admin.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Outlet</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Outlet</a></li>
                <li><a href="#">Tambah Outlet</a></li>
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
                <form method="post" action="{{ route('outlet.update', $outlet->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <input type="text" value="{{ $outlet->name }}" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Outlet</label>
                        <textarea name="address" class="form-control">{{ $outlet->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" value="{{ $outlet->phone_number }}" name="phone_number" class="form-control">
                    </div>
                    @if ($outlet->user == null)
                        <div class="form-group">
                            <label>Belum Ada Owner (silahkan pilih owner)</label>
                            <select name="owner_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->outlet != null ? 'disabled' : '' }}>
                                        @if ($user->outlet == null)
                                            {{ $user->name }} (Belum memiliki outlet)
                                        @else
                                            {{ $user->name }} (Owner di {{ $user->outlet->name }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Owner sekarang : {{ $outlet->user->name }}</label>
                            <select name="owner_id_new" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->outlet != null && $user->outlet->id != $outlet->id ? 'disabled' : '' }}>
                                        @if ($user->outlet == null)
                                            {{ $user->name }} (Belum memiliki outlet)
                                        @else
                                            {{ $user->name }} (Owner di {{ $user->outlet->name }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
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