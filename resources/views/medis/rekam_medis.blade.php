@extends('layouts.sidebar')

@section('content')
<div class="container">
    <a href="/medis/medis?tgl={{date('d-m-Y')}}" class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
    <a href="/medis/cetak_rm/pasien={{$berobat->id}}&rekammedis={{$pasien->id_pasien}}" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak rekam medis</a>
    <div class="float-end">

        <form action="{{route('selesai',$berobat->id)}}" method="POST">
            @csrf
            <input type="hidden" name="status" value="2">
        <?php if($berobat->status =='1'){
            echo '<button class="btn btn-success" type="submit" name="simpan">Selesai</button>
            <a href="/medis/edit_fisik/medis='.$berobat->medis->id.'&pasien='.$berobat->medis->berobat_id.'?tgl='.date('d-m-Y').'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             <a href="/medis/periksa_diagnosa/berobat='.$berobat->id.'&pasien='.$berobat->pasien_id.'" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Diagnosa</a>
        <a href="/medis/periksa_obat/berobat='.$berobat->id.'&pasien='.$berobat->pasien_id.'" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Obat</a>';
         }if($berobat->status =='2'){
             echo '';
          }?>
          </form>
    </div>
    <hr>
    <div class="row g-2">
        <div class="col-6">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>
                            <h5><b>No berobat</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->no_berobat}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>NIK</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->nik}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Jenis Berobat</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->jenis_berobat}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>No BPJS</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->no_bpjs}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Nama</b></h5>
                        </td>
                        <td style="text-transform: uppercase">
                            <h5>{{$pasien->nama}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Tempat tanggal lahir</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->tempat}}, {{$pasien->tanggal}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Usia</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->umur}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Jenis kelamin</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->jk}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Alamat</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->alamat}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Gol darah</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->gol_darah}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>No hp</b></h5>
                        </td>
                        <td>
                            <h5>{{$pasien->no_hp}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Tanggal Berobat</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->tgl}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Poli</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->poli}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Biaya</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->biaya}}</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>
                            <h5><b>Dokter</b></h5>
                        </td>
                        <td style="text-transform: uppercase">
                            <h5>{{$berobat->medis->dokter}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Perawat</b></h5>
                        </td>
                        <td style="text-transform: uppercase">
                            <h5>{{$berobat->medis->perawat}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Sistolik</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->sistolik}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Diastolik</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->diastolik}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Tinggi badan</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->tinggi}} Cm</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Berat badan</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->berat}} Kg</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Suhu</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->suhu}} °C</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Saturasi</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->saturasi}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Napas</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->napas}}/s</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Keluhan</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->keluhan}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Diagnosa</b></h5>
                        </td>
                        <td> @foreach($berobat->diagnosa as $d)
                            <h5>{{ $d->diagnosa }},  <?php if($berobat->status =='1'){
                                ?>
                                <a href="hapus_diagnosa/{{$d->id}}"  class=""onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a>
                                <?php
                             }if($berobat->status =='2'){
                                 echo '';
                              }?> ,</h5>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Status</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->tindakan}}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5><b>Keterangan</b></h5>
                        </td>
                        <td>
                            <h5>{{$berobat->medis->keterangan}}</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <table class="table table-striped">
        <h3>Resep obat</h3>
        <thead>
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>Dosis</th>
            <th>Pemakaian</th>
            <?php if($berobat->status =='1'){
                echo '<th>Aksi</th>';
             }if($berobat->status =='2'){
                 echo '';
              }?>
        </thead>
        @foreach($resep as $a)
        <tr>
            <td>{{ $a->nm_obat }}</td>
            <td>{{ $a->jumlah }}</td>
            <td>{{ $a->dosis }} / hari</td>
            <td>{{ $a->pakai }}</td>
            <?php if($berobat->status =='1'){
                ?>
                <td><a href="hapus_resep/{{$a->id}}" class="" onclick="javascript: return confirm('Konfirmasi data akan dihapus');">Hapus</a></td>
                <?php
             }if($berobat->status =='2'){
                 echo '';
              }?>
        </tr>
        @endforeach

    </table>
</div>
@endsection