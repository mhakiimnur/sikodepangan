<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Kelompok</th>
            <th>Nama Kelompok</th>
            <th>Komoditas → Jenis → Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data_kelompok as $item)
            <tr>
                <td>{{ $item->kode_kelompok }}</td>
                <td>{{ $item->nama_kelompok }}</td>
                <td>
                    @if($item->komoditas->count())
                        <ul>
                            @foreach($item->komoditas as $komoditas)
                                <li>
                                    <strong>{{ $komoditas->nama_komoditas }}</strong>
                                    @if($komoditas->jenis->count())
                                        <ul>
                                            @foreach($komoditas->jenis as $jenis)
                                                <li>
                                                    {{ $jenis->nama_jenis }}
                                                    @if($jenis->level->count())
                                                        <ul>
                                                            @foreach($jenis->level as $level)
                                                                <li>{{ $level->nama_level }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <em>Tidak ada komoditas</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.kelompok.show', $item->kode_kelompok) }}" class="btn btn-primary btn-sm">Detail</a>
                    <a href="{{ route('admin.kelompok.edit', $item->kode_kelompok) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelompok.destroy', $item->kode_kelompok) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
