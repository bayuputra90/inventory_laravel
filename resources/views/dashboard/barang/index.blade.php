@extends('dashboard.layout')
@section('title', 'Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Barang</h3>

        <button class="btn badge text-decoration-none ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
            <i data-feather="plus"></i>&nbsp; Add
        </button>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-hover">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th class="col-md-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kategori->nama }}</td>
                        <td>{{ $data->stok }}</td>
                        <td>
                            <a href="{{ url('barang/'. $data->id) }}" class="btn btn-info btn-sm">Detail</a> |
                            <a href="{{ url('barang/'. $data->id . '/edit') }}" class="btn btn-success btn-sm">Ubah</a> |
                            <form action="{{ url('barang/' . $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus barang ?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card rounded rounded-3">
            <div class="card-header bg-primary">
                <h1 class="card-title fs-5 text-center text-light" id="createcardLabel">Tambah Barang</h1>
            </div>
            <div class="card-body">
                <form action="{{ url('barang') }}" method="POST" id="tambahBarang">
                    @csrf
                    <div class="my-2">
                        <label for="barang" class="form-label">Nama Barang</label>
                        <input type="text" name="barang" id="barang" class="form-control">
                    </div>
                    <div class="my-2">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select type="text" name="kategori_id" id="kategori_id" class="form-select">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="tambahBarang" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
