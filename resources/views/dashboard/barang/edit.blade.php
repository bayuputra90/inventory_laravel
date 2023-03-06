@extends('dashboard.layout')
@section('title', 'Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Ubah Barang</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('barang/' . $barang->id) }}" method="POST" id="updateBarang">
            @csrf
            @method('PUT')
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-md">
                    <div class="my-2">
                        <label for="barang" class="form-label">Nama Barang</label>
                        <input type="text" name="barang" id="barang" value="{{ old('barang', $barang->nama) }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md">
                    <div class="my-2">
                        <label for="kategori_id" class="form-label">Nama Kategori</label>
                        <select type="text" name="kategori_id" id="kategori_id" class="form-select">
                            <option value="">Pilih kategori</option>
                            @foreach ($kategori as $data)
                            <option value="{{ $data->id }}" @if(old('kategori_id', $barang->kategori_id) == $data->id)
                                selected @endif>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ url('barang') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" form="updateBarang" class="btn btn-primary">Simpan</button>
    </div>
</div>
@endsection
