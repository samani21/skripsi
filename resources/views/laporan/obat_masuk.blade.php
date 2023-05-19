@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('obat/cetak_obatmasuk')}}" method="get" class="row g-12">
            <div class="col-md-2">
                <input class="form-control" type="number" name="tahun" value="{{date('Y')}}" aria-label="default input example">
                </div>
                <div class="col-md-2">
                    <input type="text" name="tgl" class="form-control"  value="{{date('d-m-Y')}}" id="">
                </div>
                <div class="col-md-2">
                    <select name="bulan" class="form-control" >
                        <option value="">--Pilih Bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="04">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
                </div>
        </form>
    </div>
    <div>
        <form action="{{route('laporan/obat_masuk')}}" method="get" class="row g-12">
            <div class="col-md-2">
                <input class="form-control" type="number" name="tahun" value="{{date('Y')}}" aria-label="default input example">
                </div>
                <div class="col-md-2">
                    <input type="text" name="tgl" class="form-control"  value="{{date('d-m-Y')}}" id="">
                </div>
                <div class="col-md-2">
                    <select name="bulan" class="form-control" >
                        <option value="">--Pilih Bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="04">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
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
                    <td>{{$o->nama_obat}}</td>
                    <td>{{$o->jumlah}}</td>
                    <td>{{$o->tgl}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $masuk->links() }}
    </div>
@endsection