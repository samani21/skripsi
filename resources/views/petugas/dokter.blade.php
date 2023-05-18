@extends('layouts.sidebar')

@section('content')

    <div>
        
        <form action="{{route('petugas/dokter')}}" method="get" class="row g-12">
            <div class="col-md-8">
            <input class="form-control" type="hidden" name="dokter" value="dokter" placeholder="Cari surat berdasarkan no surat" aria-label="default input example">

            <input class="form-control" type="text" name="nama" placeholder="Cari nama petugas" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('petugas/tambah_dokter')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Dokter</a>
                {{-- <a href="{{url('pegawai/cetak')}}" class="btn btn-success"><i class="fa-solid fa-print"></i> Cetak</a> --}}
            </div>
        </form>
    </div>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col" width="20%" >NIP</th>
                <th scope="col" width="30%" align="left">Nama</th>
                <th scope="col">Spesialis</th>
                <th scope="col">kelompok</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($petugas as $index=> $tugas)
                <tr >
                    <td data-title="No" align="center">{{ $index + $petugas->firstItem() }}</td>
                    <td data-title="Nip">{{$tugas->nip}}</td>
                    <td data-title="nama" align="left" style="text-transform: uppercase">{{$tugas->nama}}</td>
                    <td data-title="Spesialis" align="center">{{$tugas->spesialis}}</td>
                    <td data-title="Spesialis" align="center">{{$tugas->kelompok}}</td>
                    <td data-title="Aksi" align="center">
                        <?php
                        if($tugas->kelompok =='dokter'){
                          echo '<a href="edit_dokter/'.$tugas->id.'" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</a>';
                       }if($tugas->kelompok =='perawat'){
                           echo '<a href="edit_perawat/'.$tugas->id.'" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</a>';
                        }?>
                        <a href="edit_dokter/{{$tugas->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_petugas/{{$tugas->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                        <a href="tambah_jaga/{{$tugas->id}}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Jaga</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $petugas->links() }}
    </div>
@endsection