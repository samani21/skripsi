@extends('layouts.sidebar')

@section('content')
    
<h4>
    Selamat datang {{ Auth::user()->name }}, Anda login sebagai user <?php 
        if ( Auth::user()->level == "operator") {
            echo "Super Admin";
        }else {
            echo  Auth::user()->level;
        } ?>
</h4>
<hr>

    <div class="container">
        <div>
            <form action="" method="GET">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <label class="col-sm-5 col-form-label">Lihat Grafik berdasarkan tahun</label>
                            <div class="col-sm-7">
                              <input type="text" name="tahun" class="form-control" value="<?php echo date('Y'); ?>">
                            </div>
                          </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div id="container"></div>
            </div>
            <div class="col-md-6">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Pegawai</h6>
                                    <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$pegawai->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Dokter</h6>
                                    <h2 class="text-right"><i class="fa-solid fa-user-doctor"></i><span>{{$dokter->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Perawat</h6>
                                    <h2 class="text-right"><i class="fa-solid fa-user-nurse"></i><span>{{$perawat->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Pasien</h6>
                                    <h2 class="text-right"><i class="las la-users"></i><span>{{$pasien->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Berobat perhari</h6>
                                    <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$berobat->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Nama Obat</h6>
                                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obat->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Obat Masuk Perhari</h6>
                                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obatmasuk->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-xl-12">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Jumlah Obat Keluar Perhari</h6>
                                    <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obatkeluar->count()}}</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        
        
        
        
        
	</div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
          
          <script type="text/javascript">
            var jumlah = <?php echo json_encode($jum); ?>;
            var bulan  = <?php echo json_encode($bulan); ?>;
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Pasien Berobat'
                },
                xAxis: {
                    categories: bulan
                },

                yAxis: {
                    lineWidth: 1,
                    tickWidth: 1,
                    title: {
                        align: 'high',
                        offset: 0,
                        text: 'Jumlah(orang)',
                        rotation: 0,
                        y: -10
                    }
                },

                series: [{
                    data: jumlah
                }]

                });
          </script>
@endsection