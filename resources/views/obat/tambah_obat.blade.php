@extends('layouts.sidebar')

@section('content')

<form action="{{ route('obat.store') }}" method="POST">
    @csrf
        <div>
            <label for="">Nama obat</label>
            <input class="form-control" type="text" maxlength="50" id="nm_obat" name="nm_obat" placeholder="Masukkan nama obat" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input class="form-control" type="text"  maxlength="10" id="stok" name="stok"  placeholder="Masukkan angka" aria-label="default input example" required>
        </div>
        <div>
            <label>Satuan</label>
            <select name="satuan" class="form-control" required>
                <option value="pilih">--Pilih--</option>
                <option value="Tablet">Tablet</option>
                <option value="Botol">Botol</option>
            </select>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection