@extends('dashboard.layout')
@section('title', 'Permohonan Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Tambah Barang Permohonan</h3>
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
        <form action="{{ route('permohonan.simpan.item', $permohonan_id) }}" id="simpanItems" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md">
                    <div class="my-2">
                        <label for="barang" class="form-label">Pilih Barang</label>
                        <div class="row">
                            <div class="col-md">
                                <select name="barang_id" id="barang_id" class="form-select">
                                    <option value="">Pilih barang</option>
                                    @foreach ($barang as $data)
                                    <option value="{{ $data->id }}" @if(old('barang_id') == $data->id) selected @endif>{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createModal">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="my-2">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" name="merk" id="merk" class="form-control" value="{{ old('merk') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="my-2">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="my-2">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan') }}">
                    </div>
                </div>
            </div>
            <div class="my-2">
                <label for="data_dukung" class="form-label">Data Dukung</label>
                <input type="file" name="data_dukung" id="data_dukung" class="form-control">
            </div>
        </form>
    </div>
    <div class="card-footer">
        <a href="{{ route('permohonan.form', $permohonan_id) }}" class="btn btn-secondary">Batal</a>
        <button type="submit" form="simpanItems" class="btn btn-primary float-end">Simpan</button>
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
                <form action="{{ route('permohonan.tambah.item', $permohonan_id) }}" method="POST" id="tambahBarang">
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
