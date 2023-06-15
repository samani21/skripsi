@extends('layouts.sidebar')

@section('content')
    <div>
        <form action="{{route('kapuskes/kapuskes')}}" method="get" class="row g-12">
            <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama kapus" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('kapuskes/tambah_kapus')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
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
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($kapus as $index=>$kap)
                <tr align="center">
                    <td data-title="No">{{ $index + $kapus->firstItem() }}</td>
                    <td data-title="Nip">{{$kap->nip}}</td>
                    <td data-title="nama" style="text-transform: uppercase"align="left">{{$kap->nama}}</td>
                    <td data-title="Tanggal Mulai">{{date('d-m-Y', strtotime($kap->tgl_mulai))}}</td>
                    <td data-title="Tanggal Selesai">{{date('d-m-Y', strtotime($kap->tgl_selesai))}}</td>
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
                    <td data-title="Aksi">
                        <a href="edit_kapus/{{$kap->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_kapus/{{$kap->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                    <?php
                        if ($kap->status == 1) {
                            ?>
                        <a href="selesai_kapus/{{$kap->id}}" class="btn btn-primary"><i class="fa-solid fa-check-to-slot"></i></a>
                            <?php
                        }
                    ?>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $kapus->links() }}
    </div>
@endsection