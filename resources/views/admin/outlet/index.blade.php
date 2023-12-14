@extends('admin.partials.main')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Outlet</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="/admin/outlet/create" class="btn btn-primary box-title">
                            <i class="fa fa-plus fa-fw"></i>
                            <span>Tambah</span>
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
                                <th>Nama</th>
                                <th>Owner</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($outlets as $outlet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $outlet->name }}</td>
                                    <td>{{ $outlet->owner != null && $outlet->owner?->role === 'owner' ? $outlet->owner->name : 'Belum ada owner' }}</td>
                                    <td>{{ $outlet->phone_number }}</td>
                                    <td>{{ $outlet->address }}</td>
                                    <td align="center">
                                        <div style="display: flex;">
                                            <a href="/admin/outlet/{{ $outlet->id }}/edit" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="/admin/outlet/{{ $outlet->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="btn btn-danger" id="btn_delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada outlet</td>
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