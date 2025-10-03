@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Data Harga Pangan (API)</h2>
    <div class="card shadow">
        <div class="card-body">
            @if(!empty($data))
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Komoditas</th>
                            <th>Harga (Rp)</th>
                            <th>Wilayah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item['tanggal'] ?? '-' }}</td>
                                <td>{{ $item['komoditas'] ?? '-' }}</td>
                                <td>{{ number_format($item['harga'] ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $item['wilayah'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Data tidak tersedia atau API gagal dipanggil.</p>
            @endif
        </div>
    </div>
@endsection
