@extends('layouts.sidebar')

@section('content')

<form action="{{url('updateselesai',$kapus->id)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" name="nip" value="{{$kapus->nip}}" placeholder="Masukkan NIP" aria-label="default input example" maxlength="30" autofocus>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" value="{{$kapus->nama}}" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example">
        </div>
        <div>
            <label for="">Tanggal mulai</label>
            <input class="form-control" type="date" id="tgl_mulai" value="{{$kapus->tgl_mulai}}" name="tgl_mulai" required>
        </div>
        <div>
            <label for="">Tanggal selesai</label>
            <input class="form-control" type="date" value="{{$kapus->tgl_selesai}}" id="tgl_selesai" name="tgl_selesai" required>
        </div>
        <input type="hidden" name="status" value="0" id="">
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