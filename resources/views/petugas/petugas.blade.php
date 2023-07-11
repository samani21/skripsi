@extends('layouts.sidebar')

@section('content')

@if (Auth::user()->level == "operator" || Auth::user()->level == "admin")
<div class="row">
    <div class="col-md-4 col-xl-6">
        <div class="card bg-c-blue order-card">
            <div class="card-block-petugas">
                <a href="{{ url('petugas/dokter') }}" class="text-white" style="text-decoration:none"><h4 class="m-b-20"> <i class="las la-user-friends"></i><span> Dokter</span></h4></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-xl-6">
        <div class="card bg-c-green order-card">
            <div class="card-block-petugas">
                <a href="{{ url('petugas/perawat') }}"" class="text-white" style="text-decoration:none"><h4 class="m-b-20"> <i class="las la-user-friends"></i><span> Perawat</span></h4></a>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
        <tr align="center">
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelompok/Spesialis</th>
            <th scope="col">TGL</th>
            <th scope="col">Poli</th>
            <th scope="col">Mulai</th>
            <th scope="col">Selesai</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
        @foreach($jadwal as  $index=>$jad)
        <tr>
            <td data-title="No" align="center">{{ $index + $jadwal->firstItem() }}</td>
            <td data-title="Nip">{{$jad->nip}}</td>
            <td data-title="Nama" style="text-transform: uppercase">{{$jad->nama}}</td>
            <td data-title="Kelompok/Spesialis" align="center">{{$jad->kelompok}}/{{$jad->spesialis}}</td>
            <td data-title="Tgl" align="center">{{$jad->tgl}}</td>
            <td data-title="Poli" align="center">{{$jad->poli}}</td>
            <td data-title="Mulai" align="center">{{$jad->mulai}}</td>
            <td data-title="selesai" align="center">{{$jad->selesai}}</td>
            <td data-title="aksi" align="center">
                <?php
                    if($jad->status == '1'){
                        ?>
                        <a href="selesai/{{$jad->id_jadwal}}" class="btn btn-success"> Selesai</a>
                        <?php
                    }
                ?>
            </td>
        </tr>
        @endforeach

    </tbody>
    </table>
    {{$jadwal->links()}}
</div>
@endif

@if (Auth::user()->level == "rekam_medis")
    @foreach ($petugas as $pet )
    <table class="table table-striped table-hover">
        <tbody>
            <td>
                NIP : {{$pet->nip}}
            </td>
            <td>
                Nama : {{$pet->nama}}
            </td>
            <td>
                Kelompok : {{$pet->kelompok}}
            </td>
            <td>
                Spesialis : {{$pet->spesialis}}
            </td>
            <td>
                Poli : {{$pet->poli}}
            </td>
            <?php
                if (strtotime($pet->tgl_absen) == strtotime(date('Y-m-d'))) {
                    
                }else {
                    ?>
<td>
    <a href="tambah_jaga/{{$pet->id}}" class="btn btn-primary">Absen</a>
</td>
                    <?php
                }
            ?>
            <td>
                <a href="edit_dokter/{{$pet->id}}" class="btn btn-warning">Edit</a>
            </td>
        </tbody>
    </table>
    @endforeach
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
        <tr align="center">
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelompok/Spesialis</th>
            <th scope="col">TGL</th>
            <th scope="col">Poli</th>
            <th scope="col">Mulai</th>
            <th scope="col">Selesai</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
        @foreach($jadwal as  $index=>$jad)
        <tr>
            <td data-title="No" align="center">{{ $index + $jadwal->firstItem() }}</td>
            <td data-title="Nip">{{$jad->nip}}</td>
            <td data-title="Nama" style="text-transform: uppercase">{{$jad->nama}}</td>
            <td data-title="Kelompok/Spesialis" align="center">{{$jad->kelompok}}/{{$jad->spesialis}}</td>
            <td data-title="Tgl" align="center">{{$jad->tgl}}</td>
            <td data-title="Poli" align="center">{{$jad->poli}}</td>
            <td data-title="Mulai" align="center">{{$jad->mulai}}</td>
            <td data-title="selesai" align="center">{{$jad->selesai}}</td>
            <td data-title="aksi" align="center">
                <?php
                    if($jad->status == '1' && Auth::user()->id == $jad->id_user){
                        ?>
                        <a href="selesai/{{$jad->id_jadwal}}" class="btn btn-success"> Selesai</a>
                        <?php
                    }
                ?>
            </td>
        </tr>
        @endforeach

    </tbody>
    </table>
    {{$jadwal->links()}}
</div>
@endif
@endsection