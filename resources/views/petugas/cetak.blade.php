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
    <h3 align="center">LAPORAN DATA PETUGAS</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='100'>NIP</th>
                <th width='130'>Nama</th>
                <th width='80'>Kelompok</th>
                <th width='90'>Spesialis</th>
                <th width='100'>Poli</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($petugas as $pet)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{$pet->nip}}</td>
                    <td style="text-transform: uppercase">{{$pet->nama}}</td>
                    <td>{{$pet->kelompok}}</td>
                    <td>{{$pet->spesialis}}</td>
                    <td>{{$pet->poli}}</td>
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
