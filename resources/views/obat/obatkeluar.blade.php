@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('obat/obatkeluar')}}" method="get" class="row g-12">
            <div class="col-md-4">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama obat" aria-label="default input example">
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="tgl" value="<?php echo date('d-m-Y')?>">
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
                <th scope="col">Nama obat</th>
                <th scope="col">jumlah obat</th>
                <th scope="col">dosis</th>
                <th scope="col">tanggal</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($obat as  $o)
                <tr>
                    <td data-title="No"  align="center">{{ $no++ }}</td>
                    <td data-title="Nama obat">{{ $o->nm_obat }}</td>
                    <td data-title="Jumlah"  align="center">{{ $o->jumlah }}</td>
                    <td data-title="Dosis" >{{ $o->dosis }}</td>
                    <td data-title="Tanggal"  align="center">{{ $o->tgl }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection