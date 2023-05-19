<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <td align="left">
                <img src="{{public_path('css/Kayuh_Baimbai.png')}}" width='100' height='90'>
            </td>
            <td align="center">
                <p align="center">
                    <b>PEMERINTAH KOTA BANJARMASIN
                        <br>DINAS KESEHATAN
                        <br> PUSKESMAS BERUNTUNG RAYA</b><br>
                    JL.AMD Komp Tata Benua Indah RT.19 Kel.Tanjung Pagar <br>
                    Banjarmasin Selatan Telp.(0511)4225559,Email:puskesmasberuntungraya@yahoo.com
                </p>
            </td>
            <td>
                <img src="{{public_path('css/logo-puskesmas.png')}}" width='100' height='90'
                    style="padding-right: 100%">
            </td>
        </thead>
    </table>
    <hr>
    <h3 align="center">REKAM MEDIS PASIEN</h3>
    <table>
        <tbody>
            <td>
                <p><b>No rekam medis :</b> {{$pasien->no_berobat}}</p>
                <p><b>NIK :</b> {{$pasien->nik}}</p>
                <p><b>Jenis berobat :</b> {{$pasien->jenis_berobat}}</p>
                <p><b>No BPJS :</b> {{$pasien->no_bpjs}}</p>
                <p style="text-transform: uppercase"><b style="text-transform: capitalize">Nama :</b> {{$pasien->nama}}</p>
                <p><b>Tempat tanggal ahir :</b> {{$pasien->tempat}},{{$pasien->tanggal}}</p>
                <p><b>Jenis Kelamin :</b> {{$pasien->jk}}</p>
                <p><b>Alamat :</b> {{$pasien->alamat}}</p>
                <p><b>Golongan darah :</b> {{$pasien->gol_darah}}</p>
                <p><b>No hp :</b> {{$pasien->no_hp}}</p>
                <p><b>Tanggal berobat :</b> {{$berobat->medis->tgl}}</p>
                <p><b>Biaya :</b> {{$berobat->medis->biaya}}</p>
                <p><b>Ruang pemeriksaan :</b>{{$berobat->poli}}</p>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <p><b>Dokter :</b> {{$berobat->medis->dokter}}</p>
                <p><b>Perawat :</b> {{$berobat->medis->perawat}}</p>
                <p><b>Sistolik :</b> {{$berobat->medis->sistolik}}</p>
                <p><b>Diastolik :</b> {{$berobat->medis->diastolik}}</p>
                <p><b>Tinggi badan :</b>{{$berobat->medis->diastolik}} Cm</p>
                <p><b>Berat badan :</b> {{$berobat->medis->diastolik}} Kg</p>
                <p><b>Suhu :</b> {{$berobat->medis->suhu}} °C</p>
                <p><b>Saturasi :</b> {{$berobat->medis->saturasi}}</p>
                <p><b>Napas :</b> {{$berobat->medis->napas}}</p>
                <p><b>Keluhan :</b> {{$berobat->medis->keluhan}}</p>
                <p><b>status pengobatan:</b> {{$berobat->medis->tindakan}}</p>
                <p><b>Keterangan :</b>{{$berobat->medis->keterangan}}</p>
                <p><b>Diagnosa :</b>
                    @foreach($berobat->diagnosa as $d)
                    {{ $d->diagnosa }} ,
                    @endforeach
                </p>
            </td>
        </tbody>
    </table>
    <hr>
    <table align="center" style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
        <thead>
            <th width="10%">No</th>
            <th width="200">Nama Obat</th>
            <th width="100">Jumlah</th>
            <th width="100">Dosis</th>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($berobat->resep as $a)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $a->obat }}</td>
                <td align="center">{{ $a->jumlah }}</td>
                <td align="center">{{ $a->dosis }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>