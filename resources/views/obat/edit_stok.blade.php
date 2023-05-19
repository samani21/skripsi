@extends('layouts.sidebar')

@section('content')

<form action="{{route('updatestok',$obat->id)}}" method="POST">
    @csrf
        <div>
            <label for="">Tanggal</label>
            <input class="form-control" type="text" id="tgl" name="tgl" value="{{date('d-m-Y')}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
            <input class="form-control" type="hidden" id="bulan" name="bulan" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
            <input class="form-control" type="hidden" id="tahun" name="tahun" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
        </div>
        <div>
            <label for="">Kode obat</label>
            <input class="form-control" type="text" id="kode" name="kode" value="{{$obat->kode}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Nama obat</label>
            <input class="form-control" type="text" id="nama_obat" name="nama_obat" value="{{$obat->nama_obat}}" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">jumlah</label>
            <input class="form-control" type="text" maxlength="10" id="jumlah" name="jumlah" value="{{$obat->jumlah}}" aria-label="default input example" autofocus>
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection