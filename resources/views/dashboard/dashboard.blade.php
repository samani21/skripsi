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
    
        <div class="row">
            <div class="col-md-6">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-3">
                            Tahun
                        </div>
                        <div class="col-3">
                            <input type="text" name="tahun" class="form-control" value="<?php echo date('Y'); ?>">
                        </div>
                        <input type="hidden" class="form-control" name="dari" value="{{date('Y-m-d')}}">
                        <input type="hidden" class="form-control" name="sampai" value="{{date('Y-m-d')}}">
                        <div class="col-3">
                            <button type="submit">Cari</button>
                        </div>
                    </div>
                </form>
                <div id="container"></div>
            </div>
            <div class="col-md-6">
                <form action="" method="get">
                    <input type="hidden" name="tahun" class="form-control" value="<?php echo date('Y'); ?>">
                    <div class="row">
                        <div class="col-3">
                            Periode
                        </div>
                        <div class="col-3">
                            <input type="date" class="form-control" name="dari" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-3">
                            <input type="date" class="form-control" name="sampai" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-3">
                            <button type="submit">Cari</button>
                        </div>
                    </div>
                </form>
                <div id="container1"></div>
            </div>
            <div class="col-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Pegawai</h6>
                        <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$pegawai->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Dokter</h6>
                        <h2 class="text-right"><i class="fa-solid fa-user-doctor"></i><span>{{$dokter->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Perawat</h6>
                        <h2 class="text-right"><i class="fa-solid fa-user-nurse"></i><span>{{$perawat->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Berobat perhari</h6>
                        <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$berobat->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Berobat perhari</h6>
                        <h2 class="text-right"><i class="las la-user-friends"></i><span>{{$berobat->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Nama Obat</h6>
                        <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obat->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Jumlah Obat Masuk Perhari</h6>
                        <h2 class="text-right"><i class="las la-capsules"></i><span>{{$obatmasuk->count()}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
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

                var jumlah = <?php echo json_encode($d_jum); ?>;
            var bulan  = <?php echo json_encode($diagnosa); ?>;
            Highcharts.chart('container1', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Diagnosa Pasien'
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
                        text: 'Penyakit',
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