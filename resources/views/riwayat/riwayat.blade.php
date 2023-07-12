<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-color: aliceblue">
    <div>
        <nav class="navbar navbar-light bg-info">
            <div class="container-fluid">
                <h4>
                <img src="{{asset('logo-puskesmas.png')}}" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    <b>Puskesmas Beruntung Raya</b>
                </h3>
            </div>
          </nav>
    </div>
    <div align="center">
        <h4>Data Diri Pasien</h4>
    </div>
    <hr>
    <div class="container-fluid">
        <button onclick="history.back()" class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i>Kembali</button>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row g-2">
            <div class="col-6">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($pasien as $pas)
                        <tr>
                            <td><h5><b>No berobat</b></h5></td>
                            <td><h5>{{$pas->no_berobat}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>NIK</b></h5></td>
                            <td><h5>{{$pas->nik}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Jenis berobat</b></h5></td>
                            <td><h5>{{$pas->jenis_berobat}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>No BPJS</b></h5></td>
                            <td><h5>{{$pas->no_bpjs}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Nama</b></h5></td>
                            <td style="text-transform: uppercase"><h5>{{$pas->nama}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Tempat tanggal lahir</b></h5></td>
                            <td><h5>{{$pas->tempat}} ,{{$pas->tanggal}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Jenis Kelamin</b></h5></td>
                            <td><h5>{{$pas->jk}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Alamat</b></h5></td>
                            <td><h5>{{$pas->alamat}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Gol darah</b></h5></td>
                            <td><h5>{{$pas->gol_darah}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>No hp</b></h5></td>
                            <td><h5>{{$pas->no_hp}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Tanggal dibuat</b></h5></td>
                            <td><h5>{{$pas->tgl_pasien}}</h5></td>
                        </tr>
                        <tr>
                            <td><h5><b>Password Asli</b></h5></td>
                            <td><h5>{{$pas->password}}</h5></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h3 align="center">Rekam Medis</h3>
                <table class="table table-striped table-hover" id="no-more-tables">
                    <thead>
                    <tr align="center">
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Berobat</th>
                        <th>Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php 
                        $no=1;
                    @endphp
                    @foreach($berobat as $index=>$pas)
                        <tr align="center">
                            <td data-title="No">{{ $index + $berobat->firstItem() }}</td>
                            <td data-title="No">{{ $pas->tgl }}</td>
                            <td data-title="Status"><?php if($pas->status =='1'||$pas->status == '3'){
                                echo '<span class="badge bg-warning text-black">Sedang diperiksa</span>';
                             }if($pas->status =='2'){
                                echo '<span class="badge bg-success">Selesai diperiksa</span>';
                             }if($pas->status =='0'){
                                 echo '<span class="badge bg-danger">Belum diperiksa</span>';
                              }if($pas->status =='4'){
                                 echo '<span class="badge bg-primary">Selesai</span>';
                              }?></td>
                           <td>
                            <?php if($pas->status =='4' || $pas->status =='2'){
                                echo '<a href="rekam_medis/berobat='.$pas->id.'&rekammedis='.$pas->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i>Lihat</a>';
                             }if($pas->status =='1'){
                                echo '';
                             }if($pas->status =='0'){
                                 echo '';
                              }?>
                           </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="float-end">{{ $berobat->links() }}</div>
            </div>
        </div>
    </div>
</body>
</html>