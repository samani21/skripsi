@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('pasien/pasien')}}" method="get" class="row g-12">
            <div class="col-md-4">
                <input class="form-control" type="text" name="nama"placeholder="Cari nama pasien" aria-label="default input example">
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="no_berobat"placeholder="Cari pasien no berobat" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('pasien/tambah_pasien')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
                {{-- <a href="{{url('pegawai/cetak')}}" class="btn btn-success"><i class="fa-solid fa-print"></i> Cetak</a> --}}
            </div>
        </form>
    </div>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">No berobat</th>
                <th scope="col">NIK</th>
                <th scope="col">Jenis beobat</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal lahir</th>
                <th scope="col">tempat</th>
                <th scope="col">Alamat</th>
                <th scope="col">Gol darah</th>
                <th scope="col">No hp</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($pasien as $index=>$pas)
                <tr align="center">
                    <td data-title="No">{{ $index + $pasien->firstItem() }}</td>
                    <td data-title="No berobat">{{$pas->no_berobat}}</td>
                    <td data-title="NIK" align="left">{{$pas->nik}}</td>
                    <td data-title="Jenis berobat">{{$pas->jenis_berobat}}</td>
                    <td data-title="Nama" style="text-transform: uppercase">{{$pas->nama}}</td>
                    <td data-title="Tanggal lahir">{{$pas->tanggal}}</td>
                    <td data-title="Tempat lahir">{{$pas->tempat}}</td>
                    <td data-title="Alamat">{{$pas->alamat}}</td>
                    <td data-title="Gol darah">{{$pas->gol_darah}}</td>
                    <td data-title="No Hp">{{$pas->no_hp}}</td>
                    <td data-title="Aksi">
                        <a href="detail/id={{$pas->id_pasien}}&pasien_id={{$pas->id_pasien}}" class="btn btn-success"><i class="fa-solid fa-book-medical"></i></i></a>
                        <a href="edit_pasien/{{$pas->id_pasien}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="hapus_pasien/{{$pas->id_pasien}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $pasien->links() }}
    </div>
@endsection