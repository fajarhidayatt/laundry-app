@extends('admin.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Outlet</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <span>Outlet</span>
                </li>
                <li>
                    <span>Edit Outlet</span>
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
                <form action="/admin/outlet/{{ $outlet->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Outlet</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $outlet->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat Outlet</label>
                        <textarea name="address" id="address" class="form-control">{{ $outlet->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control" value="{{ $outlet->phone_number }}">
                    </div>
                    {{-- Jika outlet sudah memiliki owner --}}
                    @if ($outlet->owner != null && $outlet->owner?->role === 'owner')
                        <div class="form-group">
                            <label for="owner_id_new">Owner sekarang : {{ $outlet->owner->name }}</label>
                            <select name="owner_id_new" id="owner_id_new" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->outlet_id !== null && $user->outlet_id !== $outlet->id ? 'disabled' : '' }}> {{-- Disable `user` pemiliki outlet ini --}}
                                        @if ($user->outlet === null)
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
                            <label for="owner_id">Belum Ada Owner (silahkan pilih owner)</label>
                            <select name="owner_id" id="owner_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->outlet_id !== null ? 'disabled' : '' }}> {{-- Disable `user` yang sudah memiliki outlet --}}
                                        @if ($user->outlet_id === null)
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