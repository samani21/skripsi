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
    <h3 align="center">DATA PASEIN BEROBAT</h3>
    <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
        <thead>
        <tr align="center">
            <th width="10">No</th>
            <th width="80">No berobat</th>
            <th width="100">NIK</th>
            <th width="100">Nama</th>
            <th width="100">Jenis berobat</th>
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
                <td align="center"><?php echo $medis->tgl;?></td>
            </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>