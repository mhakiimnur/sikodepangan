@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Jenis Pangan</h1>
    <a href="{{ route('admin.jenis.index') }}" class="btn btn-danger mb-3">Kembali</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Jenis</th>
                <th>Nama Jenis</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
            </tr>
        </thead>
        <tbody>
            @if($data_level->count() > 0)
                @foreach($data_level as $index => $item)
                    <tr>
                        {{-- tampilkan Jenis hanya di baris pertama --}}
                        @if($index == 0)
                            <td rowspan="{{ $data_level->count() }}">
                                {{ $jenisPangan->kode_jenis }}
                            </td>
                            <td rowspan="{{ $data_level->count() }}">
                                {{ $jenisPangan->nama_jenis }}
                            </td>
                        @endif
                        <td>{{ $item->kode_level }}</td>
                        <td>{{ $item->nama_level }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">
                        {{ $jenisPangan->kode_jenis }} - {{ $jenisPangan->nama_jenis }} : Tidak ada data level
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $data_level->links('pagination::bootstrap-5') }}
</div>
@endsection
