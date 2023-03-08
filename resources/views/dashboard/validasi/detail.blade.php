@extends('dashboard.layout')
@section('title', 'Validasi')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Detail Permohonan Barang</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md">
                <div class="my-2">
                    <label for="judul" class="form-label">Judul Permohonan</label>
                    <input type="text" name="judul" id="judul" value="{{ $permohonan->judul }}" class="form-control"
                        disabled>
                </div>
            </div>
            <div class="col-md">
                <div class="my-2">
                    <label for="sumber" class="form-label">Sumber Anggaran</label>
                    <input type="text" name="sumber" id="sumber" value="{{ $permohonan->sumber }}" class="form-control"
                        disabled>
                </div>
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <h3 class="d-inline">Data Barang</h3>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Jumlah</th>
                    <th>Data Dukung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permohonan_items as $item)
                <tr>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->merk }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <a target="_blank" href="{{ asset('storage/' . $item->data_dukung) }}"
                            class="btn btn-sm btn-light">Data Dukung</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-3 d-flex justify-content-between">
            <a href="{{ route('validasi.index') }}" class="btn btn-secondary">Kembali</a>
            @if ($permohonan->status == 'pending')
            <div>
                <form action="{{ url('validasi/reject/' . $permohonan->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button onclick="return confirm('Reject permohonan ?')" class="btn btn-danger">
                        <i data-feather="x"></i>&nbsp; Reject
                    </button>
                </form>
                <form action="{{ url('validasi/approve/' . $permohonan->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button onclick="return confirm('Approve permohonan ?')" class="btn btn-success align-middle">
                        <i data-feather="check"></i>&nbsp; Approve
                    </button>
                </form>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
