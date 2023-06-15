@extends('layouts.sidebar')

@section('content')

@php
$tgl_sekarang    =strtotime(date('d-m-Y'));
$tgl_lusa        =date('d-m-Y', strtotime("+3 day", $tgl_sekarang));

@endphp

<form action="{{route('surat.sakit',$berobat->id) }}" method="POST">
    @csrf
        <div>
            <input type="hidden" name="poli" value="{{$berobat->poli}}">
            <input type="hidden" name="j_berobat" value="{{$berobat->jenis_berobat}}">
            <label for="">Nama</label>
            <input class="form-control" type="text" value="{{$pasien->nama}}" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Umur</label>
            <input class="form-control" type="text" value="{{$medis->umur}}" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Pekerjaan</label>
            <input class="form-control" type="text" id="pekerjaan" name="pekerjaan" maxlength="50" placeholder="Pekerjaan" aria-label="default input example" autofocus required>
        </div>
        <div>
            <label for="">Alamat</label>
            <input class="form-control" type="text" value="{{$pasien->alamat}}" maxlength="100" placeholder="Masukkan alamat" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Dari tanggal</label>
            <input class="form-control" type="text" id="tgl1" name="tgl1" value="{{date('d-m-Y')}}" maxlength="100" placeholder="Masukkan alamat" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Sampai Tanggal</label>
            <input class="form-control" type="text" id="tgl2" name="tgl2" value="{{$tgl_lusa}}" maxlength="100" placeholder="Masukkan alamat" aria-label="default input example" readonly>
        </div>
        <?php
            if ($berobat->jenis_berobat == 'BPJS') {
                ?>
                    <div>
                        <label for="">Biaya</label>
                        <input class="form-control" type="text" name="biaya" maxlength="100" value="10000" placeholder="Masukkan alamat" aria-label="default input example">
                    </div>
                <?php
            }if ($berobat->jenis_berobat == 'Umum') {
                ?>
                    <div>
                        <label for="">Biaya</label>
                        <input class="form-control" type="text" name="biaya" maxlength="100" value="5000" placeholder="Masukkan alamat" aria-label="default input example">
                    </div>
                <?php
            }
        ?>
        <div>
            <input class="form-control" type="hidden" value="-" id="riwayat" name="riwayat" maxlength="50" placeholder="Riwayat penyakit" maxlength="100" aria-label="default input example" autofocus required>
        </div>
        <div>
            <input class="form-control" type="hidden" value="-" id="keperluan" name="keperluan" maxlength="50" placeholder="Riwayat penyakit" maxlength="100" aria-label="default input example" autofocus required>
        </div>
        
        <input type="hidden" value="{{$pasien->id_pasien}}" name="pasien_id">
        <input type="hidden" value="{{$medis->id}}" name="medis_id">
        <input type="hidden" value="1" name="status">
        <input type="hidden" value="3" name="status1">
        <input type="hidden" value="{{$berobat->id}}" name="berobat_id">
        <input type="hidden" value="Surat Sakit" name="sb">
        <input type="hidden" value="<?php echo date('d-m-Y') ?>" name="tgl_b">
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
            <a href="/medis/rekam_medis/berobat={{$berobat->id}}&rekammedis={{$berobat->pasien_id}}"class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
        </div>
  </form>
@endsection