@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('kapuskes/cetak')}}" method="get" class="row g-12">
        <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama kapus"
                aria-label="default input example">
        </div>
        <input type="hidden" value="<?php echo date('d-m-Y') ?>" name="tgl" id="">
        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </form>
    <form action="{{route('laporan/kapus')}}" method="get" class="row g-12">
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
                <th scope="col">Tgl mulai</th>
                <th scope="col">Tgl selesai</th>
                <th scope="col">Lama</th>
                <th scope="col">Status</th>

            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($kapus as $kap)
            <tr align="center">
                <td data-title="No">{{ $no++ }}</td>
                <td data-title="Nip">{{$kap->nip}}</td>
                <td data-title="Nama" style="text-transform: uppercase">{{$kap->nama}}</td>
                <td data-title="Tanggal Mulai">{{$kap->tgl_mulai}}</td>
                <td data-title="Tanggal Selesai">{{$kap->tgl_selesai}}</td>
                <td data-title="Lama menjabat"> <?php 
                    if($kap->tgl_selesai == '-'){
                        echo "-";
                    }else {
                        ?>
                        @php
                        $tgl_mulai = $kap->tgl_mulai;
                        $jabat = new DateTime($tgl_mulai);
                        $tgl_selesai = new DateTime($kap->tgl_selesai);
                        $lama_jabat = $tgl_selesai->diff($jabat);
                        @endphp
                        {{$lama_jabat->y." Tahun"." ". $lama_jabat->m ." Bulan"." ".$lama_jabat->d." hari"}}
                        <?php
                    }
                    ?>
                    </td>
                <td data-title="Status"><?php
                    if ($kap->status == 0) {
                        echo "Selesai Menjabat";
                    }
                    if ($kap->status == 1) {
                        echo "Menjabat";
                    }
                    if ($kap->status == 2) {
                        echo "--Pilih--";
                    }
                ?></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kapus->links() }}
</div>
@endsection