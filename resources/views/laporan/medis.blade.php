@extends('layouts.sidebar')

@section('content')

    <div>
        <form action="{{route('medis/cetak_medis')}}" method="get" class="row g-12">
            
            <div class="col-md-6">
                <label for="">Cetak Data</label>
                <input type="text" name="tgl" class="form-control"  value="{{date('d-m-Y')}}" id="">
            </div>
            <div class="col-auto">
                <br>
            <button type="submit" class="btn btn-success mb-3"><i class="fa-solid fa-print"></i> Cetak</button>
        </form>
    </div>
    <div>
        <form action="{{route('laporan/medis')}}" method="get" class="row g-12">
            <div class="col-md-6">
                <label for="">Cari data</label>
                <input type="text" name="tgl" class="form-control"  value="{{date('d-m-Y')}}" id="">
            </div>
            <div class="col-auto">
                <br>
            <button type="submit" class="btn btn-primary mb-3"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <hr>
    <div class="table-responsive bg-white" id="no-more-tables">
        <table class="table table-striped table-hover">
            <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">No berobat</th>
                <th scope="col">NIK</th>
                <th scope="col">Jenis berobat</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal berobat</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($berobat as $medis)
                <tr align="center">
                    <td data-title="No">{{ $no++ }}</td>
                    <td data-title="No berobat">{{$medis->no_berobat}}</td>
                    <td data-title="NIK">{{$medis->nik}}</td>
                    <td data-title="Jenis berobat">{{$medis->jenis_berobat}}</td>
                    <td data-title="Nama">{{$medis->nama_berobat}}</td>
                    <td data-title="Tanggal berobat"><?php echo $medis->tgl;?></td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $berobat->links() }}
    </div>
@endsection