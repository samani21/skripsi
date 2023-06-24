@extends('layouts.sidebar')

@section('content')
 <div class="container">
    <a href="/pasien/pasien" class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
    <a href="cetak_kartu/{{$pasien->id_pasien}}" class="btn btn-success"><i class="fa-solid fa-print"></i> Kartu</a>
    <div class="float-end">
        @if(Auth::user()->level =='admin' || Auth::user()->level =='operator')
            <a href="/pasien/daftar/{{$pasien->id_pasien}}" class="btn btn-primary"><i class="fa-solid fa-syringe"></i></i> Daftar Pasien berobat</a>
        @endif
    </div>
    <hr>
    <div class="row g-2">
        <div class="col-6">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><h5><b>No berobat</b></h5></td>
                        <td><h5>{{$pasien->no_berobat}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>NIK</b></h5></td>
                        <td><h5>{{$pasien->nik}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Jenis berobat</b></h5></td>
                        <td><h5>{{$pasien->jenis_berobat}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>No BPJS</b></h5></td>
                        <td><h5>{{$pasien->no_bpjs}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Nama</b></h5></td>
                        <td style="text-transform: uppercase"><h5>{{$pasien->nama}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Tempat tanggal lahir</b></h5></td>
                        <td><h5>{{$pasien->tempat}} ,{{date('d-m-Y', strtotime($pasien->tanggal))}}</h5></td>
                    </tr>
                    <tr>
                        @php
                        $tgl_lahir = $pasien->tanggal;
                        $umur = new DateTime($tgl_lahir);
                        $sekarang = new DateTime();
                        $usia = $sekarang->diff($umur);
                        @endphp
                        <td><h5><b>Usia</b></h5></td>
                        <td><h5>{{$usia->y." Tahun"." ". $usia->m ." Bulan"." ".$usia->d." hari"}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Jenis Kelamin</b></h5></td>
                        <td><h5>{{$pasien->jk}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Alamat</b></h5></td>
                        <td><h5>{{$pasien->alamat}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Kota</b></h5></td>
                        <td><h5>{{$pasien->kota}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Gol darah</b></h5></td>
                        <td><h5>{{$pasien->gol_darah}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>No hp</b></h5></td>
                        <td><h5>{{$pasien->no_hp}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Tanggal dibuat</b></h5></td>
                        <td><h5>{{$pasien->tgl_pasien}}</h5></td>
                    </tr>
                    <tr>
                        <td><h5><b>Password</b></h5></td>
                        <td><h5>{{$pasien->password}}</h5></td>
                    </tr>
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
                        <td data-title="Status"><?php if($pas->status =='1'|| $pas->status == '3'){
                            echo '<span class="badge bg-warning text-black">Sedang diperiksa</span>';
                         }if($pas->status =='2'){
                            echo '<span class="badge bg-success">Selesai diperiksa</span>';
                         }if($pas->status =='0'){
                             echo '<span class="badge bg-danger">Belum diperiksa</span>';
                          }if($pas->status =='4'){
                             echo '<span class="badge bg-primary">Selesai</span>';
                          }?></td>
                       <td>
                        @if(Auth::user()->level =='admin' || Auth::user()->level =='operator')
                        <?php if($pas->status =='2' || $pas->status =='4'){
                            echo '<a href="rekam_medis/berobat='.$pas->id.'&rekammedis='.$pas->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i>Lihat</a>';
                         }if($pas->status =='1'){
                            echo '';
                         }if($pas->status =='0'){
                             echo '';
                          }?>
                          @endif
                          @if(Auth::user()->level =='rekam_medis' || Auth::user()->level =='operator')
                          <?php if($pas->status =='0'){
                            echo '<a href="/medis/periksa_fisik/'.$pas->id.'?tgl='.date('d-m-Y').'" class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>';
                         }if($pas->status =='1'||$pas->status =='3'){
                             echo '';
                          }?>
                    <?php if($pas->status =='1'||$pas->status =='3'){
                            echo '<a href="rekam_medis/berobat='.$pas->id.'&rekammedis='.$pas->pasien_id.'" class="btn btn-warning"><i class="fa-solid fa-laptop-medical"></i></a>';
                         }
                          if($pas->status =='2'|| $pas->status =='4'){
                            echo '<a href="rekam_medis/berobat='.$pas->id.'&rekammedis='.$pas->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i></a>';
                         }if($pas->status =='0'){
                             echo '';
                          }?>
                            @endif
                       </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <div class="float-end">{{ $berobat->links() }}</div>
        </div>
 </div>
@endsection