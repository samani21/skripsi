@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('medis/medis')}}" method="get" class="row">
        <div class="col-md-2">
            <label for=""><b>Cari rekam medis pasien</b></label>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="cari" placeholder="Cari pasien"
                aria-label="default input example">
        </div>
        <div class="col-md-4">
            <select name="poli" class="form-control">
                <option value="">--Pilih Poli--</option>
                <option value="Umum">Umum</option>
                <option value="Anak">Anak</option>
                <option value="Gigi">Gigi</option>
                <option value="KB">KB</option>
                <option value="Gizi">Gizi</option>
                <option value="kandungan">kandungan</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i
                    class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">No berobat</th>
                <th scope="col">Nama</th>
                <th scope="col">Poli</th>
                <th scope="col">Tanggal berobat</th>
                <th scope="col">Resep</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($resep as $index => $medis)
            <tr align="center">
                <td data-title="No">{{ $index + $resep->firstItem() }}</td>
                <td data-title="No berobat">{{$medis->no_berobat}}</td>
                <td data-title="Nama">{{$medis->nama}}</td>
                <td data-title="Poli">{{$medis->poli}}</td>
                <td data-title="TGL Berobat">{{$medis->tgl}}</td>
                <td data-title="Jumlah resep">{{$medis->jm}}</td>
                <td data-title="Status"><?php if($medis->status =='2'){
                    echo '<span class="badge bg-success">Selesai diperiksa</span>';
                 }if($medis->status =='4'){
                    echo '<span class="badge bg-primary">Selesai</span>';
                 }if($medis->status =='1'||$medis->status =='3'){
                    echo '<span class="badge bg-warning">Sedang diperiksa</span>';
                 }if($medis->status =='0'){
                     echo '<span class="badge bg-danger">Belum diperiksa</span>';
                  }?></td>
                <td><?php if($medis->status =='2' || $medis->status =='4'){
                    ?>
                    <a href="/medis/rekam_medis/berobat={{$medis->id}}&rekammedis={{$medis->pasien_id}}" class="btn btn-warning"><i class="fa-solid fa-laptop-medical"></i></a>
                    <?php
                 }if($medis->status =='1'||$medis->status =='3'){
                    ?>
                    <?php
                 }if($medis->status =='0'){
                    ?>
                    <?php
                  }?>
                    {{-- <a href="/medis/rekam_medis/berobat={{$medis->id}}&rekammedis={{$medis->pasien_id}}" class="btn btn-warning"><i class="fa-solid fa-laptop-medical"></i></a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $resep->links() }}
</div>
@endsection