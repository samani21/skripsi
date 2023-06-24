@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('pegawai/cetak')}}" method="get" class="row g-12">
        <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama pegawai"
                aria-label="default input example">
        </div>
        <input type="hidden" value="<?php echo date('d-m-Y') ?>" name="tgl" id="">
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </form>
    <form action="{{route('laporan/pegawai')}}" method="get" class="row g-12">
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
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal lahir</th>
                <th scope="col">tempat</th>
                <th scope="col">Alamat</th>
                <th scope="col">jenis kelamin</th>
                <th scope="col">Kelompok</th>
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Lama</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($pegawai as $peg)
            <tr align="center">
                <td data-title="No">{{ $no++ }}</td>
                <td data-title="Nip">{{$peg->nip}}</td>
                <td data-title="nama" style="text-transform: uppercase">{{$peg->nama}}</td>
                <td data-title="Tanggal lahir">{{$peg->tanggal}}</td>
                <td data-title="Tempat lahir">{{$peg->tempat}}</td>
                <td data-title="Alamat">{{$peg->alamat}}</td>
                <td data-title="Jenis kelamin">{{$peg->jns_kelamin}}</td>
                <td data-title="Kelompok">{{$peg->kelompok}}</td>
                <td data-title="Tanggal Mulai">{{date('d-m-Y', strtotime($peg->tgl_mulai))}}</td>
                    <td data-title="Tanggal Selesai">
                    <?php
                        if ($peg->tgl_selesai == '-') {
                            echo '-';
                        }else {
                           echo date('d-m-Y', strtotime($peg->tgl_selesai));
                        }
                    ?></td>
                    <td data-title="Lama menjabat"> <?php 
                    if($peg->tgl_selesai == '-'){
                        echo "-";
                    }else {
                        ?>
                        @php
                        $tgl_mulai = $peg->tgl_mulai;
                        $jabat = new DateTime($tgl_mulai);
                        $tgl_selesai = new DateTime($peg->tgl_selesai);
                        $lama_jabat = $tgl_selesai->diff($jabat);
                        @endphp
                        {{$lama_jabat->y." Tahun"." ". $lama_jabat->m ." Bulan"." ".$lama_jabat->d." hari"}}
                        <?php
                    }
                    ?>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pegawai->links() }}
</div>
@endsection