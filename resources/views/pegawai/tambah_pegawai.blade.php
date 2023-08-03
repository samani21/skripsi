@extends('layouts.sidebar')

@section('content')

<form action="{{ route('pegawai.store') }}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" name="nip" placeholder="Masukkan NIP" aria-label="default input example" maxlength="30" autofocus required>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Tanggal lahir</label>
            <input class="form-control" type="date" id="tanggal" name="tanggal"  aria-label="default input example" required>
        </div>
        <div>
            <label for="">Tempat lahir</label>
            <input class="form-control" type="text" id="tempat" name="tempat" maxlength="50" placeholder="Tempat lahir" aria-label="default input example" required> 
        </div>
        <div>
            <label for="">Alamat</label>
            <input class="form-control" type="text" id="alamat" name="alamat" maxlength="100" placeholder="Masukkan alamat" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Jenis Kelamin</label>
            <select class="form-select" name="jns_kelamin" aria-label="Default select example" required>
                <option value="" selected>--pilih--</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perumpuan">Perumpuan</option>
              </select>
        </div>
        <div>
            <label for="">Kelompok pegawai</label>
            <select class="form-select" name="kelompok" aria-label="Default select example" required>
                <option value="" selected>--pilih--</option>
                <option value="TENAGA MEDIS">TENAGA MEDIS</option>
                <option value="TENAGA KEPERAWATAN">TENAGA KEPERAWATAN</option>
                <option value="TENAGA KETEKNISIAN MEDIS">TENAGA KETEKNISIAN MEDIS</option>
                <option value="TENAGA GIZI">TENAGA GIZI</option>
                <option value="TENAGA KESEHATAN MASYARAKAT">TENAGA KESEHATAN MASYARAKAT</option>
                <option value="TENAGA KEFARMASIAN">TENAGA KEFARMASIAN</option>
                <option value="NON MEDIS">NON MEDIS</option>
              </select>
        </div>
        <div>
            <label for="">Spesialis</label>
            <select class="form-select" name="spesialis" aria-label="Default select example" required>
                <option value="" selected>--pilih--</option>
                <option value="Dokter Umum">Dokter Umum</option>
                <option value="Dokter Gigi">Dokter Gigi</option>
                <option value="Bidan">Bidan</option>
                <option value="Asisten Apoteker">Asisten Apoteker</option>
                <option value="Perawat">Perawat</option>
                <option value="Ahli Teknologi laboratorium Medis">Ahli Teknologi laboratorium Medis</option>
                <option value="Perawat Gigi">Perawat Gigi</option>
                <option value="Ahli Gizi">Ahli Gizi</option>
                <option value="Penuluhan Kesehatan">Penuluhan Kesehatan</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Staf Non Medis">Staf Non Medis</option>
              </select>
        </div>
        <div>
            <label for="">Tanggal mulai</label>
            <input class="form-control" type="date" id="tgl_mulai" name="tgl_mulai" required>
        </div>
        <div>
            <input class="form-control" type="hidden" value="-" id="tgl_selesai" name="tgl_selesai" required>
        </div>
        <input type="hidden" name="status" value="1">
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection