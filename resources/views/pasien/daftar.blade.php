@extends('layouts.sidebar')

@section('content')

<form action="{{route('tambah.store',$pasien->id_pasien)}}" method="POST" class="row g-2">
    @csrf
       <div class="col-6">
        <input class="form-control" type="hidden" id="pasien_id" name="pasien_id" value="{{$pasien->id_pasien}}"  placeholder="Masukkan no berobat" aria-label="default input example" readonly>
            <div>
                <label for="">No berobat</label>
                <input class="form-control" type="text" id="no_berobat" name="no_berobat" value="{{$pasien->no_berobat}}"  placeholder="Masukkan no berobat" aria-label="default input example" readonly>
            </div>
            <div>
                <label for="">NIK</label>
                <input class="form-control" type="number" id="nik" name="nik" value="{{$pasien->nik}}" placeholder="Masukkan nik" aria-label="default input example" readonly>
            </div>
            <div>
                <label>Jenis berobat</label>
                <select name="jenis_berobat" class="form-control" onchange=" 
                    if (this.selectedIndex==1 )
                    { document.getElementById('umum').style.display ='inline'}
                    else { document.getElementById('umum').style.display = 'none' }if (this.selectedIndex==2 )
                    { document.getElementById('bpjs').style.display ='inline'}
                    else { document.getElementById('bpjs').style.display = 'none' };">
    
                    <option value="{{$pasien->jenis_berobat}}">{{$pasien->jenis_berobat}}</option>
                    <option value="Umum">Umum</option>
                    <option value="BPJS">BPJS</option>
                </select>
    
                <span id="umum" <?php if($pasien->jenis_berobat =='Umum'){
                    echo 'style="display:inline;"';
                 }if($pasien->jenis_berobat =='BPJS'){
                     echo 'style="display:none;"';
                  }?>>
                    <label for="">Biaya</label>
                    <input type="text" name="umum" maxlength="10" value="-"class="form-control">
                </span>
                <span id="bpjs" <?php if($pasien->jenis_berobat =='BPJS'){
                    echo 'style="display:inline;"';
                 }if($pasien->jenis_berobat =='Umum'){
                     echo 'style="display:none;"';
                  }?>>
                    <label>No BPJS</label>
                    <input type="text" name="bpjs" maxlength="17" value="{{$pasien->no_bpjs}}"class="form-control">
                </span>
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" id="nama" maxlength="50" name="nama_berobat" style="text-transform: uppercase" value="{{$pasien->nama}}" placeholder="Masukkan nama" aria-label="default input example" readonly>
            </div>
            <div>
                <label for="">Tanggal lahir</label>
                <input class="form-control" type="date" id="tanggal"  name="tanggal" value="{{$pasien->tanggal}}" aria-label="default input example" readonly>
            </div>
            <div>
                <label for="">Umur</label>
               @php
               $tgl_lahir = $pasien->tanggal;
               $umur = new DateTime($tgl_lahir);
               $sekarang = new DateTime();

               $usia = $sekarang->diff($umur);

             
               @endphp
                <input class="form-control" type="text" id="umumr" name="umur" value="{{$usia->y." Tahun"." ". $usia->m ." Bulan"." ".$usia->d." hari"}}" readonly>
            </div>
        </div>
        <div class="col-6">
            <div>
                <label for="">Tanggal berobat</label>
                <input class="form-control" type="text" id="tgl" name="tgl" value="@php echo date('d-m-Y') @endphp" aria-label="default input example" readonly>
                <input class="form-control" type="hidden" id="bulan" name="bulan" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
                <input class="form-control" type="hidden" id="tahun" name="tahun" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
            </div>
            <div>
                <label for="">Tempat lahir</label>
                <input class="form-control" type="text" id="tempat" name="tempat" value="{{$pasien->tempat}}" placeholder="Tempat lahir" aria-label="default input example"readonly>
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control" type="text" id="alamat" name="alamat" value="{{$pasien->alamat}}" placeholder="Masukkan alamat" aria-label="default input example"readonly>
            </div>
            <div>
                <label for="">Gol darah</label>
                <input class="form-control" type="text" id="gol_darah" name="gol_darah" value="{{$pasien->gol_darah}}" placeholder="" aria-label="default input example"readonly>
            </div>
            <div>
                <label for="">No hp</label>
                <input class="form-control" type="text" id="no_hp" name="no_hp" value="{{$pasien->no_hp}}" placeholder="Masukkan no hp" aria-label="default input example"readonly>
            </div>
            <input type="hidden" value="{{$pasien->password}}" name="password">
            <div>
                <input class="form-control" type="hidden" id="status" name="status" value="0" placeholder="Masukkan no hp" aria-label="default input example">
            </div>
            <div>
                <label>Poli</label>
                <select name="poli" class="form-control" required>
                    <option value="">--Pilih--</option>
                    <option value="Umum">Umum</option>
                    <option value="Anak">Anak</option>
                    <option value="Gigi">Gigi</option>
                    <option value="KB">KB</option>
                    <option value="Gizi">Gizi</option>
                    <option value="kandungan">kandungan</option>
                </select>
            </div>
            <input type="hidden" value="Pendaftaran" name="sb">
            <input type="hidden" value="<?php echo date('d-m-Y') ?>" name="tgl_b">
            <div>
                <br>
                <a href="#" onclick="goBack()" class="btn btn-warning float-end">Batal</a>
                <button type="submit" class="btn btn-success float-end" name="simpan">Simpan</button>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
            </div>
        </div>
  </form>
@endsection