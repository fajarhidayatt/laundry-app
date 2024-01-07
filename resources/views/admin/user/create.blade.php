@extends('partials.main')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Tambah Pengguna</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li>
                        <span>Pengguna</span>
                    </li>
                    <li>
                        <span>Tambah Pengguna</span>
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
                    <form action="{{ route('admin.user.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="owner">Owner</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>
                        <div class="form-group" id="outlet_wrapper" style="display: none;">
                            <label for="outlet_id">Outlet</label>
                            <select name="outlet_id" id="outlet_id" class="form-control" disabled>
                                @foreach ($outlets as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                            <small>Note: pilih outlet dimana kasir akan ditempatkan</small>
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

    <script>
        const role = document.getElementById('role');

        role.addEventListener('change', () => {
            if (role.value === 'kasir') { /// jika role yang dipilih `kasir`, maka tampilkan select `outlet`
                document.getElementById('outlet_wrapper').style.display = 'block';
                document.getElementById('outlet_id').removeAttribute('disabled');
            } else { /// jika selain role `kasir`, maka sembunyikan
                document.getElementById('outlet_wrapper').style.display = 'none';
                document.getElementById('outlet_id').setAttribute('disabled', '');
            }
        })
    </script>
@endsection
