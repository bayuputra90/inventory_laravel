@extends('dashboard.layout')
@section('title', 'Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Detail Barang</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md">
                <div class="my-2">
                    <label for="barang" class="form-label">Nama Barang</label>
                    <input type="text" name="barang" id="barang" value="{{ $barang->nama }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md">
                <div class="my-2">
                    <label for="kategori_id" class="form-label">Nama Kategori</label>
                    <input type="text" name="kategori_id" id="kategori_id" value="{{ $barang->kategori->nama }}" class="form-control" disabled>
                </div>
            </div>
        </div>
        <hr>
        <h3 class="card-title">Merk & Stok</h3>
        <table class="table table-hover">
            <thead class="table-success">
                <tr>
                    <th>Merk</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permohonan_items as $item)
                    <tr>
                        <td>{{ $item->merk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->satuan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('barang') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
