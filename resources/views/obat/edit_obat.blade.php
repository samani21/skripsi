@extends('layouts.sidebar')

@section('content')

<form action="{{url('updateobat',$obat->kode)}}" method="POST">
    @csrf
        <div>
            <label for="">Nama obat</label>
            <input class="form-control"  maxlength="50" type="text" id="nm_obat" name="nm_obat" value="{{$obat->nm_obat}}" placeholder="Masukkan nama" aria-label="default input example" required>
        </div>
        <div>
            <label for="">jumlah</label>
            <input class="form-control" type="text" maxlength="10" id="stok" name="stok" value="{{$obat->stok}}" aria-label="default input example" required>
        </div>
        <div>
            <label>Satuan</label>
            <select name="satuan" class="form-control" required>
                <option value="{{$obat->satuan}}">{{$obat->satuan}}</option>
                <option value="Tablet">Tablet</option>
                <option value="Botol">Botol</option>
            </select>
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection