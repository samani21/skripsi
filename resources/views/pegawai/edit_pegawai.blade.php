@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatepegawai',$pegawai->id)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" maxlength="30" name="nip" value="{{$pegawai->nip}}" placeholder="Masukkan NIP" aria-label="default input example">
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" maxlength="50" name="nama" value="{{$pegawai->nama}}" style="text-transform: uppercase" placeholder="Masukkan nama" aria-label="default input example">
        </div>
        <div>
            <label for="">Tanggal lahir</label>
            <input class="form-control" type="date" id="tanggal" name="tanggal" value="{{$pegawai->tanggal}}" aria-label="default input example">
        </div>
        <div>
            <label for="">Tempat lahir</label>
            <input class="form-control" type="text" id="tempat" maxlength="50" name="tempat" value="{{$pegawai->tempat}}"  placeholder="Tempat lahir" aria-label="default input example">
        </div>
        <div>
            <label for="">Alamat</label>
            <input class="form-control" type="text" id="alamat" maxlength="100" name="alamat" value="{{$pegawai->alamat}}"  placeholder="Masukkan alamat" aria-label="default input example">
        </div>
        <div>
            <label for="">Jenis Kelamin</label>
            <select class="form-select" name="jns_kelamin" aria-label="Default select example">
                <option value="{{$pegawai->jns_kelamin}}" >{{$pegawai->jns_kelamin}}</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perumpuan">Perumpuan</option>
              </select>
        </div>
        <div>
            <label for="">Kelompok pegawai</label>
            <select class="form-select" name="kelompok" aria-label="Default select example">
                <option value="{{$pegawai->kelompok}}" selected>{{$pegawai->kelompok}}</option>
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
            <select class="form-select" name="spesialis" aria-label="Default select example">
                <option value="{{$pegawai->spesialis}}"selected>{{$pegawai->spesialis}}</option>
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
        <?php
            if ($pegawai->status == 0) {
                ?>
                <div>
                    <label for="">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example" required>
                        <option selected value="{{$pegawai->status}}"><?php
                            if ($pegawai->status == 0) {
                                echo "Selesai Menjabat";
                            }
                            if ($pegawai->status == 1) {
                                echo "Menjabat";
                            }
                        ?></option>
                        <option value="1">Sedang Menjabat</option>
                        <option value="0">Selesai Menjabat</option>
                      </select>
                </div>

                <?php
            }
            if ($pegawai->status == 1) {
                ?>
                <input type="hidden" name="status" value="1" id="">

                <?php
            }

        ?>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection