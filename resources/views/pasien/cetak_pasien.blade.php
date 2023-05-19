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
    <h3 align="center">DATA PASIEN</h3>
    <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
        <thead>
        <tr align="center">
            <th width='10'>No</th>
        <th width='40'>RM</th>
        <th width='80'>NIK</th>
        <th width='10'>Status</th>
        <th width='70'>Nama</th>
        <th width='50'>Tgl lahir</th>
        <th width='50'>Tmpt lahir</th>
        <th width='80'>Alamat</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
        @foreach($pasien as $pas)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{$pas->no_berobat}}</td>
                <td>{{$pas->nik}}</td>
                <td>{{$pas->jenis_berobat}}</td>
                <td style="text-transform: uppercase">{{$pas->nama}}</td>
                <td align="center">{{$pas->tanggal}}</td>
                <td>{{$pas->tempat}}</td>
                <td>{{$pas->alamat}}</td>
                
            </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>