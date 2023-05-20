@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatejadwal',$jadwal->id_jadwal)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" maxlength="30" id="nip"  value="{{$jadwal->petugas->nip}}" placeholder="Masukkan NIP" aria-label="default input example" autofocus readonly>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" maxlength="50" style="text-transform: uppercase" value="{{$jadwal->petugas->nama}}" type="text"  placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input class="form-control" maxlength="50" style="text-transform: uppercase" value="{{date('d-m-Y')}}" type="text" id="tgl" name="tgl" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Selesai Jaga</label>
            <input class="form-control" maxlength="50" style="text-transform: uppercase" value="{{date('h:i:s A')}}" type="text" id="selesai" name="selesai" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        
        <div>
            <input type="hidden" name="petugas_id" value="{{$jadwal->petugas->id}}" id="" readonly>
        </div>
        <div>
            <input type="hidden" name="mulai" value="{{$jadwal->mulai}}" id="" readonly>
        </div>
        <div>
            <input type="hidden" name="status" value="0" id="" readonly>
        </div>
        
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection