@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatepasien',$pasien->id_pasien)}}" method="POST">
    @csrf
    <div class="row g-2">
        <div class="col-6">
            <div>
                <label for="">No berobat</label>
                <input class="form-control" maxlength="6" type="text" id="no_berobat" name="no_berobat" value="{{$pasien->no_berobat}}"
                    placeholder="Masukkan no berobat" aria-label="default input example">
            </div>
            <div>
                <label for="">NIK</label>
                <input class="form-control"  maxlength="20" type="text" id="nik" name="nik" value="{{$pasien->nik}}"
                    placeholder="Masukkan nik" aria-label="default input example">
            </div>
            <div>
                <label>Jenis berobat</label>
                <select name="jenis_berobat" class="form-control" onchange=" 
                    if (this.selectedIndex==2 )
                    { document.getElementById('bpjs').style.display ='inline'}
                    else { document.getElementById('bpjs').style.display = 'inline' };">
                    <option value="{{$pasien->jenis_berobat}}">{{$pasien->jenis_berobat}}</option>
                    <option value="Umum">Umum</option>
                    <option value="BPJS">BPJS</option>
                </select>
                <span id="bpjs" style="display:none;">
                    <label>No BPJS</label>
                    <input type="text" name="no_bpjs" value="{{$pasien->no_bpjs}}" class="form-control">
                </span>
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" maxlength="50" type="text" id="nama" name="nama" value="{{$pasien->nama}}"
                    placeholder="Masukkan nama" style="text-transform: uppercase" aria-label="default input example">
            </div>
            <div>
                <label for="">Tanggal lahir</label>
                <input class="form-control" type="date" id="tanggal" name="tanggal" value="{{$pasien->tanggal}}"
                    aria-label="default input example">
            </div>
            <div>
                <label>Jenis kelamin</label>
                <select name="jk" class="form-control" >
                    <option value="{{$pasien->jk}}">{{$pasien->jk}}</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div>
                <input class="form-control" type="hidden" id="tgl" name="tgl_pasien" value="{{$pasien->tgl_pasien}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
                <input class="form-control" type="hidden" id="bulan" name="bulan_pasien" value="{{$pasien->bulan_pasien}}" placeholder="Masukkan NIP" aria-label="default input example">
                <input class="form-control" type="hidden" id="tahun" name="tahun_pasien" value="{{$pasien->tahun_pasien}}" placeholder="Masukkan NIP" aria-label="default input example">
            </div>
            <div>
                <label for="">Tempat lahir</label>
                <input class="form-control" maxlength="50" type="text" id="tempat" name="tempat" value="{{$pasien->tempat}}"
                    placeholder="Tempat lahir" aria-label="default input example">
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control"  maxlength="100" type="text" id="alamat" name="alamat" value="{{$pasien->alamat}}"
                    placeholder="Masukkan alamat" aria-label="default input example">
            </div>
            <div>
                <label for="">Koa</label>
                <input class="form-control" type="text" maxlength="100" id="kota" name="kota" value="{{$pasien->kota}}" placeholder="Masukkan alamat" aria-label="default input example" required>
            </div>
            <div>
                <label>Golongan darah</label>
                <select name="gol_darah" class="form-control" >
                    <option value="{{$pasien->gol_darah}}" selected>{{$pasien->gol_darah}}</option>
                    <option value="-">-</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
            </div>
            <div>
                <label for="">No hp</label>
                <input class="form-control" maxlength="15" type="text" id="no_hp" name="no_hp" value="{{$pasien->no_hp}}"
                    placeholder="Masukkan no hp" aria-label="default input example">
            </div>
            <div>
                <label for="">passwrod</label>
                <input class="form-control" type="text" id="password" value="{{$pasien->password}}" name="password"
                    placeholder="Masukkan no hp" aria-label="default input example">
            </div>
            <hr>
            <div>
                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </div>
</form>
@endsection