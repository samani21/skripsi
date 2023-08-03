@extends('layouts.sidebar')

@section('content')

<form action="{{ route('kapus.store') }}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" name="nip" placeholder="Masukkan NIP" aria-label="default input example" maxlength="30" autofocus>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example">
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
            <a href="#" class="btn btn-danger" onclick="goBack()">Back</a>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
        </div>
  </form>
@endsection