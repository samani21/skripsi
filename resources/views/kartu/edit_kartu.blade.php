@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatekartu',$kartu->no)}}" method="POST">
    @csrf
        <div>
            <label for="">No Kartu Berobat</label>
            <input class="form-control" type="text" value="{{$kartu->no}}" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">NIK</label>
            <input class="form-control" type="text" id="nik" name="nik" value="{{$kartu->nik}}" aria-label="default input example" autofocus required>
        </div>
        <div>
            <label for="">Nama KK</label>
            <input class="form-control" type="text" id="nama" name="nama" value="{{$kartu->nama}}"placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Alamat</label>
            <input class="form-control" type="text" id="alamat" name="alamat" value="{{$kartu->alamat}}" maxlength="100" placeholder="Masukkan alamat" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Tanggal lahir</label>
            <input class="form-control" type="date" id="tgl" name="tgl" value="{{$kartu->tgl}}" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Tempat lahir</label>
            <input class="form-control" type="text" value="{{$kartu->tempat}}"id="tempat" name="tempat" maxlength="50" placeholder="Tempat lahir" aria-label="default input example" required>
        </div>
        <div>
            <label for="">Jenis Kelamin</label>
            <select class="form-select" name="jk" aria-label="Default select example">
                <option selected>{{$kartu->jk}}</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perumpuan">Perumpuan</option>
              </select>
        </div>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection