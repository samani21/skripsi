@extends('layouts.sidebar')

@section('content')

<form action="{{ route('pasien.store')}}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-6">
            <div>
                <label for="">No berobat</label>
                <input class="form-control" type="text" id="no_berobat"value="<?php if ($nomor <= '9') {
                    echo "P000".$nomor;
                }else
                if ($nomor <= '99') {
                    echo "P00".$nomor;
                }
                else
                if ($nomor <= '999') {
                    echo "P0".$nomor;
                }else
                if ($nomor <= '9999') {
                    echo "P".$nomor;
                }else {
                    echo $nomor;
                } ?>" name="no_berobat" placeholder="Masukkan no berobat" aria-label="default input example" maxlength="6" readonly>
            </div>
            <div>
                <label for="">NIK</label>
                <input class="form-control" type="text" id="nik" name="nik" placeholder="Masukkan nik" aria-label="default input example" maxlength="16" required autofocus>
            </div>
            <div>
                <label>Jenis berobat</label>
                <select name="jenis_berobat" class="form-control" onchange=" 
                    if (this.selectedIndex==2 )
                    { document.getElementById('bpjs').style.display ='inline'}
                    else { document.getElementById('bpjs').style.display = 'none' };">

                    <option value="pilih">--Pilih--</option>
                    <option value="Umum">Umum</option>
                    <option value="BPJS">BPJS</option>
                </select>
                <span id="bpjs" style="display:none;">
                    <label>No BPJS</label>
                    <input type="text" name="no_bpjs" value="-" class="form-control">
                </span>
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" maxlength="50" type="text" id="nama" name="nama" placeholder="Masukkan nama" style="text-transform: uppercase" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Tanggal lahir</label>
                <input class="form-control" type="date" id="tanggal" name="tanggal"  aria-label="default input example" required>
            </div>
            <div>
                <label>Jenis kelamin</label>
                <select name="jk" class="form-control" >
                    <option value="pilih">--Pilih--</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div>
                <input class="form-control" type="hidden" id="tgl" name="tgl_pasien" value="{{date('d-m-Y')}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
                <input class="form-control" type="hidden" id="bulan" name="bulan_pasien" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
                <input class="form-control" type="hidden" id="tahun" name="tahun_pasien" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
            </div>
            <div>
                <label for="">Tempat lahir</label>
                <input class="form-control" maxlength="50" type="text" id="tempat" name="tempat" placeholder="Tempat lahir" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control" type="text" maxlength="100" id="alamat" name="alamat" placeholder="Masukkan alamat" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Kota</label>
                <input class="form-control" type="text" maxlength="100" id="kota" name="kota" placeholder="Masukkan alamat" aria-label="default input example" required>
            </div>
            <div>
                <label>Golongan darah</label>
                <select name="gol_darah" class="form-control" >
                    <option value="-">--Pilih--</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
            </div>
            <div>
                <label for="">No hp</label>
                <input class="form-control" type="text" id="no_hp" maxlength="15" name="no_hp" placeholder="Masukkan no hp" aria-label="default input example" required>
            </div>
            <input type="hidden" value="{{date('jnyGi')}}" name="password">
            <hr>
            <div>
                <button name="simpan" type="submit" class="btn btn-success">Simpan</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </div>
    </div>
        
  </form>
@endsection