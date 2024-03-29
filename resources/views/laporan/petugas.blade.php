@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('petugas/cetak')}}" method="get" class="row g-12">
        <div class="col-md-4">
            <input class="form-control" type="text" name="cari" placeholder="Cari"
                aria-label="default input example">
        </div>
        <div class="col-md-4">
            <select name="poli" class="form-control">
                <option value="">--Pilih--</option>
                <option value="Poli Umum">Poli Umum</option>
                <option value="Poli Anak">Poli Anak</option>
                <option value="Poli Gigi">Poli Gigi</option>
                <option value="Poli KB">Poli KB</option>
                <option value="Poli Gizi">Poli Gizi</option>
                <option value="Poli Kandungan">Poli Kandungan</option>
            </select>
        </div>
        <input type="hidden" value="<?php echo date('d-m-Y') ?>" name="tgl" id="">
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </form>
    <form action="{{route('laporan/petugas')}}" method="get" class="row g-12">
        <div class="col-md-4">
            <input class="form-control" type="text" name="cari" placeholder="Cari pegawai"
                aria-label="default input example">
        </div>
           <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i
                    class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
            <tr align="center">
                <th scope="col">No </th>
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelompok</th>
                <th scope="col">Spesialis</th>
                <th scope="col">Poli</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($petugas as $index=>$pet)
            <tr align="center">
                <td data-title="No">{{ $index + $petugas->firstItem()}}</td>
                <td data-title="Nip">{{$pet->nip}}</td>
                <td data-title="nama" style="text-transform: uppercase">{{$pet->nama}}</td>
                <td data-title="Kelompok">{{$pet->kelompok}}</td>
                <td data-title="Spesialis">{{$pet->spesialis}}</td>
                <td data-title="Poli">{{$pet->poli}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $petugas->links() }}
</div>
@endsection