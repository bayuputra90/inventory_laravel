@extends('dashboard.layout')
@section('title', 'Permohonan Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Permohonan Barang</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md">
                <div class="my-2">
                    <label for="judul" class="form-label">Judul Permohonan</label>
                    <input type="text" name="judul" id="judul" value="{{ $permohonan->judul }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md">
                <div class="my-2">
                    <label for="sumber" class="form-label">Sumber Anggaran</label>
                    <input type="text" name="sumber" id="sumber" value="{{ $permohonan->sumber }}" class="form-control" disabled>
                </div>
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <h3 class="d-inline">Data Barang</h3>
            <a href="{{ route('permohonan.items', $permohonan->id) }}" class="btn btn-sm btn-primary float-end">Tambah Barang</a>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Jumlah</th>
                    <th>Data Dukung</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permohonan_items as $item)
                    <tr>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->merk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <a target="_blank" href="{{ asset('storage/' . $item->data_dukung) }}" class="btn btn-sm btn-light">Data Dukung</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('permohonan.hapus.item', [$item->id, $permohonan->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus item ?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-3">
            <a href="{{ route('permohonan.index') }}" class="btn btn-secondary">Kembali</a>
            @if ($permohonan_items->count() != null)
            <form action="{{ route('permohonan.simpan', $permohonan->id) }}" method="POST" class="d-inline float-end">
                @csrf
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
            @endif
        </div>

    </div>
</div>
@endsection
