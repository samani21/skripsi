@extends('layouts.sidebar')

@section('content')
    <div>
        <form action="{{route('kartu/kartu')}}" method="get" class="row g-12">
            <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari nama KK" aria-label="default input example">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="col-auto">
                <a href="{{url('kartu/tambah_kartu')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">Kartu Berobat</th>
                <th scope="col">NIK</th>
                <th scope="col">Nama KK</th>
                <th scope="col">Alamat</th>
                <th scope="col">TTL</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($kartu as $index=>$kar)
                <tr align="center">
                    <td data-title="No">{{ $index + $kartu->firstItem() }}</td>
                    <td data-title="Kartu Berobat"><?php if($kar->no <= '9'){ 
                        echo '000',$kar->no;}else
                        if($kar->no <= '99'){ 
                        echo '00',$kar->no;}else
                        if($kar->no <= '999'){ 
                        echo '0',$kar->no;}else
                        if($kar->no <= '9999'){ 
                        echo $kar->no;}
                        ?>
                    </td>
                    <td data-title="NIK">{{$kar->nik}}</td>
                    <td data-title="nama" style="text-transform: uppercase"align="left">{{$kar->nama}}</td>
                    <td data-title="TTL" align="left">{{$kar->tempat}}</td>
                    <td data-title="Alamat" >{{$kar->alamat}}</td>
                    <td data-title="Jenis kelamin">{{$kar->jk}}</td>
                    <td data-title="Aksi">
                        <a href="edit_kartu/{{$kar->no}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_kartu/{{$kar->no}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                        <a href="cetak_kartu/{{$kar->no}}" class="btn btn-success"><i class="fa-solid fa-print"></i> Kartu</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $kartu->links() }}
    </div>
@endsection