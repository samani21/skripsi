@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('laporan/kapus')}}" method="get" class="row g-12">
        <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama pegawai"
                aria-label="default input example">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i
                    class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="col-auto">
            <a href="/biaya/cetak?tgl=<?php echo date('d-m-Y') ?>" class="btn btn-success"><i class="fa-solid fa-print"></i> Cetak</a>
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
                <td data-title="No Berobat"><?php if($b->no_berobat <= '9'){ 
                    echo '000',$b->no_berobat;}else
                    if($b->no_berobat <= '99'){ 
                    echo '00',$b->no_berobat;}else
                    if($b->no_berobat <= '999'){ 
                    echo '0',$b->no_berobat;}else
                    if($b->no_berobat <= '9999'){ 
                    echo $b->no_berobat;}
                    ?>
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
{{-- <div><div>
    Total BIaya Hari tanggl = @foreach ($total as $bi)
        {{$bi->total}}
    @endforeach
</div></div> --}}
@endsection