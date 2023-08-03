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
    <h3 align="center">LAPORAN DATA PASEIN BEROBAT</h3>
    <p>
        Periode : {{date('d-m-Y', strtotime($dari))}} / {{date('d-m-Y', strtotime($sampai))}}
    </p>
    <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
        <thead>
        <tr align="center">
            <th width="10">No</th>
            <th width="60">No berobat</th>
            <th width="100">NIK</th>
            <th width="100">Nama</th>
            <th width="100">Jenis berobat</th>
            <th width="40">Poli</th>
            <th width="100">Tanggal berobat</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
        @foreach($medis as $medis)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{$medis->no_berobat}}</td>
                <td>{{$medis->nik}}</td>
                <td>{{$medis->nama_berobat}}</td>
                <td align="center">{{$medis->jenis_berobat}}</td>
                <td>{{$medis->poli}}</td>
                <td align="center">{{date('d-m-Y', strtotime($medis->tgl))}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
    <div>
        <h4>
            <pre>Jumlah Pasien BPJS : {{$p_bpjs->count()}} Orang
Jumlah Pasien Umum : {{$p_umum->count()}} Orang</pre>
        </h4>
    </div>
    <div>
        <pre align="right">
                                            Banjarmasin,{{date('d-m-Y')}}




                        
                        @foreach ($kapus as $k )
                    {{$k->nama}}
                                            {{$k->nip}}
                        @endforeach

                                               
        </pre>
    </div>
</body>
</html>