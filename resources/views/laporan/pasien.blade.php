@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('pasien/cetak_pasien')}}" method="get" class="row g-12">
            <div class="col-md-8">
                <label for="">Cetak data</label>
            <input class="form-control" type="text" name="cari" aria-label="default input example">
            </div>
            <div class="col-md-4">
                <br>
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>
    <div>
        <form action="{{route('laporan/pasien')}}" method="get" class="row g-12">
            <div class="col-10">
                <input class="form-control" type="text" name="cari" placeholder="Cari berdasarkan nama" aria-label="default input example">
            </div>
            <div class="col-2">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
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
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($pasien as $index=> $pas)
                <tr align="center">
                    <td data-title="No">{{ $index + $pasien->firstItem() }}</td>
                    <td data-title="No berobat">{{$pas->no_berobat}}</td>
                    <td data-title="NIK">{{$pas->nik}}</td>
                    <td data-title="Jenis berobat">{{$pas->jenis_berobat}}</td>
                    <td data-title="Nama">{{$pas->nama}}</td>
                    <td data-title="Tanggal lahir">{{$pas->tanggal}}</td>
                    <td data-title="Tempat lahir">{{$pas->tempat}}</td>
                    <td data-title="Alamat">{{$pas->alamat}}</td>
                    <td data-title="Gol darah">{{$pas->gol_darah}}</td>
                    <td data-title="No Hp">{{$pas->no_hp}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $pasien->links() }}
    </div>
    <div>
        <h4>
            <pre>Jumlah Pasien BPJS : {{$p_bpjs->count()}} Orang
Jumlah Pasien Umum : {{$p_umum->count()}} Orang</pre>
        </h4>
    </div>
@endsection