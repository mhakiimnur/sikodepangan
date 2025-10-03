@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Jenis Pangan</h1>

    <form action="{{ route('jenis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kode dan Nama Komoditas </label>
            <select name="kode_komoditas" id="kode_komoditas" class="form-control" required>
                <option value="">--Pilih Komoditas--</option>
                @foreach($data_komoditas as $komoditas)
                    <option value="{{ $komoditas->kode_komoditas }}">
                        {{ $komoditas->kode_komoditas }} - {{ $komoditas->nama_komoditas }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label>Kode Jenis (6 Digit Angka)</label>
            <input type="number" name="kode_jenis" id="kode_jenis" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#kode_komoditas').on('change', function() {
        let kode_komoditas = $(this).val();
        if(kode_komoditas){
            $.get("{{ url('/get-last-jenis') }}/" + kode_komoditas, function(data){
                $('#kode_jenis').val(data.nextKode);
            });
        }else{
            $('#kode_jenis').val('');
        }
    });
</script>
@endsection
