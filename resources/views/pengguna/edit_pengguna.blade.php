@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatepengguna',$pengguna->id)}}" method="POST">
    @csrf
        <div>
            <label for="">Name</label>
            <input class="form-control" type="text" maxlength="30" name="name" value="{{$pengguna->name}}" placeholder="Masukkan NIP" aria-label="default input example">
        </div>
        <div>
            <label for="">Username</label>
            <input class="form-control" type="text"  maxlength="50" name="username" value="{{$pengguna->username}}" style="text-transform: uppercase" placeholder="Masukkan nama" aria-label="default input example">
        </div>
        <div>
            <label for="">Level</label>
            <select name="level" class="form-control">
                <option value="{{$pengguna->level}}">{{$pengguna->level}}</option>
                <option value="admin">Admin</option>
                <option value="rekam_medis">Rekam medis</option>
                <option value="apotek">Apotek</option>
                <option value="kapus">Kapus</option>
                <option value="operator">Operator</option>
            </select>
        </div>
        <div>
            <label for="">Email</label>
            <input class="form-control" type="text" name="email" value="{{$pengguna->email}}" aria-label="default input example">
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