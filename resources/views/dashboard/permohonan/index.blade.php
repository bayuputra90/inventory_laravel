@extends('dashboard.layout')
@section('title', 'Permohonan Barang')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Permohonan Barang</h3>

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
                    <th>Tanggal</th>
                    <th>Kode ID</th>
                    <th>Judul Permohonan</th>
                    <th>Sumber Anggaran</th>
                    <th class="text-center">Status</th>
                    <th class="col-md-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permohonan as $data)
                    <tr>
                        <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->judul }}</td>
                        <td>{{ $data->sumber }}</td>
                        <td class="text-center">
                            <span class="badge text-bg-{{ $data->color_status }}">{{ $data->status }}</span>
                        </td>
                        <td>
                            <a href="{{ url('permohonan/detail_permohonan/'. $data->id) }}" class="btn btn-info btn-sm">Detail</a>
                            @if ($data->status == 'draft')
                                <span class="align-middle text-black-50">|</span>
                                <a href="{{ url('permohonan/form_permohonan/'. $data->id) }}" class="btn btn-success btn-sm">Ubah</a>
                                <form action="{{ url('permohonan/hapus_permohonan' . $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <span class="align-middle text-black-50">|</span>
                                    <button onclick="return confirm('Yakin hapus permohonan ?')" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif
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
                <h1 class="card-title fs-5 text-center text-light" id="createcardLabel">Permohonan Barang</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('permohonan.buat') }}" method="POST" id="tambahPermohonan">
                    @csrf
                    <div class="my-2">
                        <label for="judul" class="form-label">Judul Permohonan</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>
                    <div class="my-2">
                        <label for="sumber" class="form-label">Sumber Anggaran</label>
                        <input type="text" name="sumber" id="sumber" class="form-control">
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="tambahPermohonan" class="btn btn-primary">Buat Permohonan</button>
            </div>
        </div>
    </div>
</div>
@endsection
