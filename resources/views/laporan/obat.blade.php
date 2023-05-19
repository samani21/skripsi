@extends('layouts.sidebar')

@section('content')
<div>
    <form action="{{route('obat/cetak_obat')}}" method="get" class="row g-12">
        <div class="col-md-10">
        <input class="form-control" type="text" name="cari" placeholder="cetak berdasarkan nama obat" aria-label="default input example">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </form>
</div>
<br>
    <div>
        <form action="{{route('laporan/obat')}}" method="get" class="row g-12">
            <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari berdasarkan nama obat" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">Kode obat</th>
                <th scope="col">Nama obat</th>
                <th scope="col">stok</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($obat as $o)
                <tr align="center">
                    <td data-title="No">{{ $no++ }}</td>
                    <td data-title="Nip">{{$o->kode}}</td>
                    <td data-title="nama">{{$o->nm_obat}}</td>
                    <td data-title="Tanggal lahir">{{$o->stok}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $obat->links() }}
    </div>
@endsection