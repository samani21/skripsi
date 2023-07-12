@extends('layouts.sidebar')

@section('content')
    <div>
        <form action="{{route('pengguna/pengguna')}}" method="get" class="row g-12">
            <div class="col-md-10">
            <input class="form-control" type="text" name="cari" placeholder="Cari pengguna" aria-label="default input example">
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
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
                <th scope="col">Email Verifikasi</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($pengguna as $index=>$peng)
                <tr align="center">
                    <td data-title="No">{{ $index + $pengguna->firstItem() }}</td>
                    <td data-title="Nama">{{$peng->name}}</td>
                    <td data-title="Username"align="left">{{$peng->username}}</td>
                    <td data-title="Email">{{$peng->email}}</td>
                    <td data-title="Level" >{{$peng->level}}</td>
                    <td data-title="Email verifikasi">{{$peng->email_verified_at}}</td>
                    <td data-title="Aksi">
                        <a href="edit_pengguna/{{$peng->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="hapus_pengguna/{{$peng->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> hapus</a>
                    </td>
            @endforeach
        </tbody>
        </table>
        {{ $pengguna->links() }}
    </div>
@endsection