@extends('layouts.sidebar')

@section('content')

<form action="{{ route('jaga.store') }}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" maxlength="30" id="nip"  value="{{$jadwal->nip}}" placeholder="Masukkan NIP" aria-label="default input example" autofocus readonly>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" maxlength="50" style="text-transform: uppercase" value="{{$jadwal->nama}}" type="text"  placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input class="form-control" value="{{date('Y-m-d')}}" type="text" id="tgl" name="tgl" readonly>
        </div>
        <div>
            <label for="">Mulai Jaga</label>
            <input class="form-control" maxlength="50" style="text-transform: uppercase" value="{{date('h:i:s A')}}" type="text" id="mulai" name="mulai" placeholder="Masukkan nama" aria-label="default input example" readonly>
        </div>
        
        <div>
            <input type="hidden" name="petugas_id" value="{{$jadwal->id}}" id="" readonly>
        </div>
        <div>
            <input type="hidden" name="selesai" value="-" id="" readonly>
        </div>
        <div>
            <input type="hidden" name="status" value="1" id="" readonly>
        </div>
        <div>
            <input type="hidden" name="id" value="{{$jadwal->id}}" id="" readonly>
        </div>
        
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <a href="#" class="btn btn-danger" onclick="goBack()">Back</a>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
  </form>
@endsection