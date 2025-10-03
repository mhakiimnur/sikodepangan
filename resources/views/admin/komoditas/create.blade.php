@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Komoditas Pangan</h1>

    <form action="{{ route('komoditas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kode dan Nama Kelompok </label>
            <select name="kode_kelompok" id="kode_kelompok" class="form-control" required>
                <option value="">--Pilih Kelompok--</option>
                @foreach($data_kelompok as $kelompok)
                    <option value="{{ $kelompok->kode_kelompok }}">
                        {{ $kelompok->kode_kelompok }} - {{ $kelompok->nama_kelompok }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label>Kode Komoditas (4 Digit Angka)</label>
            <input type="number" name="kode_komoditas" id="kode_komoditas" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label>Nama Komoditas</label>
            <input type="text" name="nama_komoditas" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('komoditas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#kode_kelompok').on('change', function() {
        let kode_kelompok = $(this).val();
        if(kode_kelompok){
            $.get("{{ url('/get-last-komoditas') }}/" + kode_kelompok, function(data){
                $('#kode_komoditas').val(data.nextKode);
            });
        }else{
            $('#kode_komoditas').val('');
        }
    });
</script>
@endsection

