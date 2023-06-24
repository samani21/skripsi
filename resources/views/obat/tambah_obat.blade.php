@extends('layouts.sidebar')

@section('content')

<form action="{{ route('obat.store') }}" method="POST">
    @csrf
        <div>
            <label for="">Kode Obat</label>
            <input class="form-control" type="text"  name="kode" value="<?php if ($nomor <= '9') {
                echo "KA000".$nomor;
            }else
            if ($nomor <= '99') {
                echo "KA00".$nomor;
            }
            else
            if ($nomor <= '999') {
                echo "KA0".$nomor;
            }else
            if ($nomor <= '9999') {
                echo "KA".$nomor;
            }else {
                    echo $nomor;
            } ?>" placeholder="Masukkan no berobat" aria-label="default input example" maxlength="6" readonly>
        </div>
        <div>
            <label for="">Nama obat</label>
            <input class="form-control" type="text" maxlength="50" id="nm_obat" name="nm_obat" placeholder="Masukkan nama obat" aria-label="default input example">
        </div>
        <div>
            <label for="">Jumlah</label>
            <input class="form-control" type="text"  maxlength="10" id="stok" name="stok"  placeholder="Masukkan angka" aria-label="default input example" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection