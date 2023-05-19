@extends('layouts.sidebar')

@section('content')
    
<h4>
    Selamat datang {{ Auth::user()->name }}, Anda login sebagai user {{ Auth::user()->level }}
</h4>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Pegawai</h6>
                    <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$pegawai->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Dokter</h6>
                    <h2 class="text-right"><i class="fa-solid fa-user-doctor"></i><span>{{$dokter->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Perawat</h6>
                    <h2 class="text-right"><i class="fa-solid fa-user-nurse"></i><span>{{$perawat->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Pasien</h6>
                    <h2 class="text-right"><i class="las la-users"></i><span>{{$pasien->count()}}</span></h2>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Berobat perhari</h6>
                    <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$berobat->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Nama Obat</h6>
                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obat->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Obat Masuk Perhari</h6>
                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obatmasuk->count()}}</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Jumlah Obat Keluar Perhari</h6>
                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obatkeluar->count()}}</span></h2>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection