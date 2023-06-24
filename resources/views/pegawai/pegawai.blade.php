@extends('layouts.sidebar')

@section('content')
    <div>
        <form action="{{route('pegawai/pegawai')}}" method="get" class="row g-12">
            <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama pegawai" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('pegawai/tambah_pegawai')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
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
                <th scope="col">TTL</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Kelompok</th>
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Lama</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($pegawai as $index=>$peg)
                <tr align="center">
                    <td data-title="No">{{ $index + $pegawai->firstItem() }}</td>
                    <td data-title="Nip">{{$peg->nip}}</td>
                    <td data-title="nama" style="text-transform: uppercase"align="left">{{$peg->nama}}</td>
                    <td data-title="Tanggal lahir">{{$peg->tempat}},{{date('d-m-Y',strtotime($peg->tanggal))}}</td>
                    <td data-title="Alamat" >{{$peg->alamat}}</td>
                    <td data-title="No Hp">{{$peg->jns_kelamin}}</td>
                    <td data-title="Kelompok">{{$peg->kelompok}}-{{$peg->spesialis}}</td>
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
                    <td data-title="Aksi">
                        <a href="edit_pegawai/{{$peg->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_pegawai/{{$peg->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                        <?php
                        if ($peg->status == 1) {
                            ?>
                        <a href="selesai_pegawai/{{$peg->id}}" class="btn btn-primary"><i class="fa-solid fa-check-to-slot"></i></a>
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