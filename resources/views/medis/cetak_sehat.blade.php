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
    <h3 align="center">SURAT SEHAT </h3>
    <table>
        <tbody>@foreach($surat as $sur)
            <pre>    Yang bertanda tangan dibawah ini Dokter pemeriksaan Puskesmas 
    Beruntung Raya menerangkan bahwa:

    Sdr/Sdri  : {{$sur->nama}}
    Umur      : {{$sur->umur}}
    Pekerjaan : {{$sur->pekerjaan}}
    Alamat    : {{$sur->alamat}}

    Hasil pemeriksaan kami pada tanggal {{$sur->tgl1}} di Puskesmas 
    Beruntung Raya sebagai berikut:

    Berat Badan      : {{$sur->berat}} Kg
    Tinggi Badan     : {{$sur->tinggi}} Cm
    Tekanan Darah    : {{$sur->sistolik}}/{{$sur->diastolik}}
    Golongan Darah   : {{$sur->gol_darah}}
    Riwayat Penyakit : {{$sur->riwayat}}
    Keperluan        : {{$sur->keperluan}}

    Surat keterangan sehat ini digunakan sebagai pembutan Simp
    demikian surat keterangan ini dibuat untuk dapat dipergunakan
    sebagai mestinya

                                            Banjarmasin,{{$sur->tgl1}}
                                            Dokter/Bidan/pemeriksan




                                            {{$sur->dokter}}
            </pre>
          
            @endforeach
        </tbody>
    </table>
</body>

</html>