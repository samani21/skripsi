@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('obat/obat')}}" method="get" class="row g-12">
            <div class="col-md-8">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama obat" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('obat/tambah_obat')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah</a>
                {{-- <a href="{{url('obat/cetak_obat')}}" class="btn btn-success"><i class="fa-solid fa-print"></i> Cetak</a> --}}
            </div>
        </form>
    </div>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">Nama obat</th>
                <th scope="col">stok</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($obat as $index=> $o)
                <tr align="center">
                    <td data-title="No">{{ $index + $obat->firstItem() }}</td>
                    <td data-title="nama">{{$o->nm_obat}}</td>
                    <td data-title="Tanggal lahir">{{$o->stok}}</td>
                    <td data-title="Aksi">
                        <a href="tambah_stok/{{$o->kode}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Stok</a>
                        <a href="edit_obat/{{$o->kode}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_obat/{{$o->kode}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $obat->links() }}
    </div>
@endsection