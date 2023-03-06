@extends('dashboard.layout')
@section('title', 'Kategori')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Kategori</h3>

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
                    <th>Kategori</th>
                    <th class="col-md-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>
                            <a href="{{ url('kategori/'. $data->id . '/edit') }}" class="btn btn-success btn-sm">Ubah</a> |
                            <form action="{{ url('kategori/' . $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus kategori ?')" class="btn btn-danger btn-sm">Hapus</button>
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
                <h1 class="card-title fs-5 text-center text-light" id="createcardLabel">Tambah Kategori</h1>
            </div>
            <div class="card-body">
                <div class="my-2">
                    <form action="{{ url('kategori') }}" method="POST" id="tambahKategori">
                        @csrf
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control">
                    </form>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="tambahKategori" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
