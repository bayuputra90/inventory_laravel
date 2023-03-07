@extends('dashboard.layout')
@section('title', 'Home')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-light">Chart Barang</h3>
            </div>
            <div class="card-body">
                chart here <br><br><br>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-light">Permohonan Barang</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th>Permohonan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $data)
                        <tr>
                            <td>{{ $data->judul }}</td>
                            <td><span class="badge text-bg-{{ $data->color_status }}">{{ $data->status }}</span></td>
                            <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
