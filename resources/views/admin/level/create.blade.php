@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><i class="bi bi-bar-chart-fill fs-1"></i> | Tambah Level Pangan</h2>
        </div>
        <form action="{{ route('level.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="kode_jenis" class="form-label">Jenis Pangan</label>
                <select name="kode_jenis" id="kode_jenis" class="form-control" required>
                    <option value="">--Pilih Jenis Pangan--</option>
                    @foreach($data_jenis as $jenis)
                        <option value="{{ $jenis->kode_jenis }}">
                            {{ $jenis->kode_jenis }} - {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori Level</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">--Pilih Kategori Level--</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_level" class="form-label">Nama Level</label>
                <input type="text" name="nama_level" id="nama_level" class="form-control" readonly required>
            </div>        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('level.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#kode_jenis').change(function(){
                let kodeJenis = $(this).val();

                if(kodeJenis){
                    $.get("{{ url('/level/available-categories') }}/" + kodeJenis, function(data){
                        let kategoriSelect = $('#kategori');
                        kategoriSelect.empty();
                        kategoriSelect.append('<option value="">--Pilih Kategori Level--</option>');

                        data.available.forEach(function(item){
                            kategoriSelect.append('<option value="'+item.key+'">'+item.label+'</option>');
                        });

                        // Simpan nama_jenis untuk nanti dipakai auto-nama_level
                        $('#kategori').data('namaJenis', data.nama_jenis);
                    });
                }
            });

            $('#kategori').change(function(){
                let selectedText = $("#kategori option:selected").text();
                let namaJenis = $(this).data('namaJenis');

                if(selectedText && namaJenis){
                    $('#nama_level').val(namaJenis + " Tingkat " + selectedText.replace(/\(.*\)/, "").trim());
                }
            });
        });
    </script>
@endsection
