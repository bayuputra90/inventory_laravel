@extends('dashboard.layout')
@section('title', 'Validasi')
@section('content')
<div class="card">
    <div class="card-header bg-primary d-flex">
        <h3 class="card-title text-light">Validasi</h3>
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
                    <th>Status</th>
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
                            <a href="{{ url('validasi/detail_permohonan/'. $data->id) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
