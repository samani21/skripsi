@extends('layouts.sidebar')

@section('content')
@foreach ($obat as $obat)
    
<form action="{{route('updatestok',$obat->id)}}" method="POST">
    @csrf
        <div>
            <label for="">Tanggal</label>
            <input class="form-control" type="text" style="background-color: #dddddd" id="tgl" name="tgl" value="{{date('d-m-Y')}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
            <input class="form-control" type="hidden" id="bulan" name="bulan" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
            <input class="form-control" type="hidden" id="tahun" name="tahun" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
        </div>
        <div>
            <label for="">Kode obat</label>
            <input class="form-control" type="text" style="background-color: #dddddd" id="kode" name="kode" value="<?php if ($obat->kode <= '9') {
                echo "KA000".$obat->kode;
            }else
            if ($obat->kode <= '99') {
                echo "KA00".$obat->kode;
            }
            else
            if ($obat->kode <= '999') {
                echo "KA0".$obat->kode;
            }else
            if ($obat->kode <= '9999') {
                echo "KA".$obat->kode;
            }else {
                echo $obat->kode;
            } ?>" placeholder="Masukkan NIP" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Nama Obat</label>
            <input class="form-control" type="text" maxlength="10" style="background-color: #dddddd" value="{{$obat->nm_obat}}" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">jumlah</label>
            <input class="form-control" type="text" maxlength="10" id="jumlah" name="jumlah" value="{{$obat->jumlah}}" aria-label="default input example" autofocus>
        </div>
        <div>
            <label for="">No Surat</label>
            <input class="form-control" type="text" id="no_surat" name="no_surat" value="{{$obat->no_surat}}" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Penerima</label>
            <input class="form-control" type="text" id="penarima" name="penerima" value="{{$obat->penerima}}" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
  @endforeach
@endsection