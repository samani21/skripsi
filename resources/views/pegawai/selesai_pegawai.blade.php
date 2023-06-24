@extends('layouts.sidebar')

@section('content')

<form action="{{url('selesai_pegawai',$pegawai->id)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" name="nip" value="{{$pegawai->nip}}" placeholder="Masukkan NIP" aria-label="default input example" maxlength="30" autofocus>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" value="{{$pegawai->nama}}" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example">
        </div>
        <div>
            <label for="">Tanggal mulai</label>
            <input class="form-control" type="date" id="tgl_mulai" value="{{$pegawai->tgl_mulai}}" name="tgl_mulai" required>
        </div>
        <div>
            <label for="">Tanggal selesai</label>
            <input class="form-control" type="date" value="{{$pegawai->tgl_selesai}}" id="tgl_selesai" name="tgl_selesai" required>
        </div>
        <input type="hidden" name="status" value="0" id="">
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection