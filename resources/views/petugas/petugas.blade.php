@extends('layouts.sidebar')

@section('content')

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
            <td data-title="No">{{ $index + $jadwal->firstItem() }}</td>
            <td data-title="Nip">{{$jad->nip}}</td>
            <td data-title="Nama">{{$jad->nama}}</td>
            <td data-title="Kelompok/Spesialis">{{$jad->kelompok}}</td>
            <td data-title="Tgl">{{$jad->tgl}}</td>
            <td data-title="Mulai">{{$jad->mulai}}</td>
            <td data-title="selesai">{{$jad->selesai}}</td>
            {{-- <td data-title="aksi">{{$jad->nip}}</td> --}}
        </tr>
        @endforeach

    </tbody>
    </table>
    {{ $jadwal->links() }}
</div>
@endsection