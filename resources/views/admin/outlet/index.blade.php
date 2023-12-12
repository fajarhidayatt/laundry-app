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
                        <a href="{{ route('outlet.create') }}" class="btn btn-primary box-title">
                            <i class="fa fa-plus fa-fw"></i>
                            Tambah
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
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item?->user != null ? $item->user->name : 'Belum ada owner' }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td align="center">
                                        <div style="display: flex;">
                                            <a href="{{ route('outlet.edit', $item->id) }}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action={{ route('outlet.destroy', $item->id) }} method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
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