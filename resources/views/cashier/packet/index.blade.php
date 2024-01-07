@extends('partials.main')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data Paket</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/cashier/packet/create" class="btn btn-primary box-title">
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
                                    <th>Nama Paket</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packets as $packet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $packet->name }}</td>
                                        <td>{{ $packet->type }}</td>
                                        <td>{{ $packet->price }}</td>
                                        <td align="center">
                                            <div class="btn-group" style="display: flex;" role="group">
                                                <a href="{{ route('cashier.packet.edit', $packet->id) }}"
                                                    data-toggle="tooltip" data-placement="bottom" title="Edit"
                                                    class="btn btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('cashier.packet.destroy', $packet->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-toggle="tooltip" data-placement="bottom"
                                                        title="Hapus" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada paket</td>
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
