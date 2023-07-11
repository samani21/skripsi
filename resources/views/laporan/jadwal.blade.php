@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('petugas/cetak_jadwal')}}" method="get" class="row g-12">
        <div class="col-md-5">
            <label for="">Dari</label>
            <input class="form-control" type="date" name="dari" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
        </div>
        <div class="col-md-5">
            <label for="">Sampai</label>
            <input class="form-control" type="date" name="sampai" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
        <br>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="cari" placeholder="Cari"
                aria-label="default input example">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </form>
    <form action="{{route('laporan/jadwal')}}" method="get" class="row g-12">
        <div class="col-md-4">
            <input class="form-control" type="text" name="tgl" value="<?php echo date('Y-m-d') ?>"
                aria-label="default input example">
        </div>
           <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i
                    class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
<hr>
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
        <tr align="center">
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelompok/Spesialis</th>
            <th scope="col">TGL</th>
            <th scope="col">Poli</th>
            <th scope="col">Mulai</th>
            <th scope="col">Selesai</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
        @foreach($jadwal as  $index=>$jad)
        <tr>
            <td data-title="No" align="center">{{ $index + $jadwal->firstItem() }}</td>
            <td data-title="Nip">{{$jad->nip}}</td>
            <td data-title="Nama" style="text-transform: uppercase">{{$jad->nama}}</td>
            <td data-title="Kelompok/Spesialis" align="center">{{$jad->kelompok}}/{{$jad->spesialis}}</td>
            <td data-title="Tgl" align="center">{{$jad->tgl}}</td>
            <td data-title="Poli" align="center">{{$jad->poli}}</td>
            <td data-title="Mulai" align="center">{{$jad->mulai}}</td>
            <td data-title="selesai" align="center">{{$jad->selesai}}</td>
        </tr>
        @endforeach

    </tbody>
    </table>
    {{ $jadwal->links() }}
</div>
@endsection