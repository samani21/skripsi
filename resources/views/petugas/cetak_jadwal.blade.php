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
    <h3 align="center">LAPORAN JADWAL PETUGAS</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='80'>NIP</th>
                <th width='100'>Nama</th>
                <th width='auto'>Kelompok/Spesialis</th>
                <th width='auto'>TGL</th>
                <th width='auto'>Poli</th>
                <th width='auto'>Mulai</th>
                <th width='auto'>Selesai</th>   
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($jadwal as $jad)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td>{{$jad->nip}}</td>
                    <td style="text-transform: uppercase">{{$jad->nama}}</td>
                    <td>{{$jad->kelompok}}/{{$jad->spesialis}}</td>
                    <td>{{$jad->tgl}}</td>
                    <td>{{$jad->poli}}</td>
                    <td>{{$jad->mulai}}</td>
                    <td>{{$jad->selesai}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
        <div>
            <pre align="right">
                                                Banjarmasin,{{$tgl}}




                            
                            @foreach ($kapus as $k )
                            {{$k->nama}}
                                                        {{$k->nip}}
                            @endforeach

                                                   
            </pre>
        </div>
</body>
</html>
