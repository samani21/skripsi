@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('biaya/cetak')}}" method="get" class="row g-12">
       @if (Auth::user()->level == 'admin')
       <input type="hidden" value="{{$jenis}}" name="jenis">
       @endif
        <div class="col-md-5">
            <label for="">Dari</label>
            <input class="form-control" type="date" name="dari" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
        </div>
        <div class="col-md-5">
            <label for="">Sampai</label>
            <input class="form-control" type="date" name="sampai" placeholder="cari" value="<?php echo date('Y-m-d') ?>"  autocomplete="off" aria-label="default input example">
        <br>
        </div>
        <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari"
                aria-label="default input example">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
        {{-- <div class="col-auto">
            <a href="/biaya/cetak?tgl=<?php echo date('d-m-Y') ?>" class="btn btn-success"><i class="fa-solid fa-print"></i> Cetak</a>
        </div> --}}
    </form>
    <form action="{{route('laporan/biaya')}}" method="get" class="row g-12">
        <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama pegawai"
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
                <th scope="col">No</th>
                <th scope="col">No berobat</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis berobat</th>
                <th scope="col">Poli</th>
                <th scope="col">Biaya</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal</th>


            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($biaya as $index=>$b)
            <tr align="center">
                <td data-title="No">{{ $index + $biaya->firstItem() }}</td>
                <td data-title="No Berobat">{{$b->no_berobat}}
                </td>
                <td data-title="Nama">{{$b->nama}}</td>
                <td data-title="Jenis Berobat">{{$b->j_berobat}}</td>
                <td data-title="Poli">{{$b->poli}}</td>
                <td data-title="Biaya">{{$b->biaya}}</td>
                <td data-title="Status">{{$b->status}}</td>
                <td data-title="Tanggal">{{$b->tgl}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $biaya->links() }}
</div>
<hr>
@if (Auth::user()->level == 'admin')
<div class="row g-2">
    <div class="col-6"><div class="col-md-6 col-xl-12">
        <div class="card bg-c-biaya order-card">
            <div class="card-block">
                <h4>
                    <pre>Jumlah Pasien pasien : {{$pasien->count()}} Orang
Total Biaya Hari tanggl = Rp.@foreach ($total as $bi){{$bi->total}}@endforeach
                </h4>
            </div>
        </div>
    </div>
</div>
    
@endif
@if (Auth::user()->level == 'operator')
<div class="row g-2">
    <div class="col-6"><div class="col-md-6 col-xl-12">
        <div class="card bg-c-biaya order-card">
            <div class="card-block">
                <h4>
                    <pre>Jumlah Pasien BPJS : {{$p_bpjs->count()}} Orang
Jumlah Pasien Umum : {{$p_umum->count()}} Orang</pre>
                </h4>
            </div>
        </div>
    </div></div>
    <div class="col-6"><div class="col-md-6 col-xl-12">
        <div class="card bg-c-biaya order-card">
            <div class="card-block">
                <h6>
                    <pre>
Jumlah Biaya BPJS : Rp.@foreach ($b_bpjs as $umum){{$umum->total}}@endforeach

Jumlah Biaya Umum : Rp.@foreach ($b_umum as $umum){{$umum->total}}@endforeach

Total Biaya Hari tanggl = Rp.@foreach ($total as $bi){{$bi->total}}@endforeach
                    </pre>
                </h6>
            </div>
        </div>
    </div></div>
</div>
    
@endif
{{-- <div><div>
    Total BIaya Hari tanggl = @foreach ($total as $bi)
        {{$bi->total}}
    @endforeach
</div></div> --}}
@endsection