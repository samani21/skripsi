@extends('layouts.sidebar')

@section('content')

<form action="{{route('diagnosa.store',$berobat->id)}}" method="POST">
    @csrf
    <input type="hidden" id="berobat_id" name="berobat_id" value="{{$berobat->id}}">
    {{-- <input class="form-control" type="hidden" id="status" name="status" value="2"> --}}

    <div>
        <div>
            <label for="">Nama Diagnosa</label>
            <input class="form-control" maxlength="100" name="diagnosa" list="diagnosa" id="exampleDataList" autocomplete="off">
            <datalist id="diagnosa">
                @foreach($icd as $diagnosa)
                <option value="({{$diagnosa->code}}). {{$diagnosa->name_id}}">
                    @endforeach
            </datalist>
        </div>
        <input type="hidden" value="{{$berobat->id}}" name="berobat">
        <input type="hidden" value="{{$berobat->pasien_id}}" name="pasien">
        <br>
        <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
        <a href="/medis/rekam_medis/pasien={{$berobat->id}}&rekammedis={{$berobat->pasien_id}}" class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i>
            Kembali</a>
    </div>
</form>
@endsection