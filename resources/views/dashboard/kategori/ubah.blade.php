@extends('dashboard.layout')
@section('title', 'Kategori')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Ubah Kategori</h3>
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
        <div class="my-2">
            <form action="{{ url('kategori/' . $kategori->id) }}" method="POST" id="tambahKategori">
                @csrf
                @method('PUT')
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" id="kategori" value="{{ $kategori->nama }}" class="form-control">
            </form>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('kategori') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" form="tambahKategori" class="btn btn-primary float-end">Simpan</button>
    </div>
</div>
@endsection
