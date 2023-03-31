@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatepetugas',$perawat->id)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" maxlength="30" id="nip" name="nip" value="{{$perawat->nip}}" placeholder="Masukkan NIP" aria-label="default input example">
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" maxlength="50" id="nama" style="text-transform: uppercase" name="nama" value="{{$perawat->nama}}" placeholder="Masukkan nama" aria-label="default input example">
        </div>
        <div>
            <input class="form-control" type="hidden" id="kelompok" name="kelompok" value="{{$perawat->kelompok}}"  placeholder="TENAGA KEPERAWATAN-Perawat" aria-label="default input example">
        </div>
        <div>
            <label for="">Spesialis</label>
            <select class="form-select" name="spesialis" aria-label="Default select example">
                <option value="{{$perawat->spesialis}}" selected>{{$perawat->spesialis}}</option>
                <option value="Perawat">Perawat</option>
                <option value="Perawat Anak">Perawat Anak</option>
                <option value="Bidan">Bidan</option>
                <option value="Perawat Gigi">Perawat Gigi</option>
                <option value="Ahli Gizi">Ahli Gizi</option>
              </select>
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection