@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('obat/cetak_obatmasuk')}}" method="get" class="row g-12">
            <div class="col-md-5">
                <label for="">Dari</label>
                <input class="form-control" type="date" name="dari" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
            </div>
            <div class="col-md-5">
                <label for="">Sampai</label>
                <input class="form-control" type="date" name="sampai" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
            <br>
            </div>
            <div class="col-8">
                <input class="form-control" type="text" name="cari"  placeholder="cari" autocomplete="off" aria-label="default input example">
            </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
                </div>
        </form>
    </div>
    <div>
        <form action="{{route('laporan/obat_masuk')}}" method="get" class="row g-12">
            <div class="col-md-11">
                <input class="form-control" type="text" name="cari"  placeholder="cari" autocomplete="off" aria-label="default input example">
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
                <th>No</th>
                <th>Nama obat</th>
                <th>stok</th>
                <th>Tanggal masuk</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($masuk as $index=>$o)
                <tr align="center">
                    <td>{{ $index + $masuk->firstItem()}}</td>
                    <td>{{$o->nm_obat}}</td>
                    <td>{{$o->jumlah}}</td>
                    <td>{{$o->tgl}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $masuk->links() }}
    </div>
@endsection