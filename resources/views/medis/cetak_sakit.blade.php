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
    <h3 align="center">SURAT SAKIT </h3>
    <table>
        <tbody>@foreach($surat as $sur)
            <pre>    bertanda tangan di bawah ini menerangkan bahwa:

    Sdr/Sdri  : {{$sur->nama}}
    Umur      : {{$sur->umur}}
    Pekerjaan : {{$sur->pekerjaan}}
    Alamat    : {{$sur->alamat}}

    Perlu beristirahat selama 3 hari, dari {{$sur->tgl1}} s/d {{$sur->tgl2}}
    karena sakit.
    Demikian agar yang berkempetingan memaklumi


                                            Banjarmasin,{{$sur->tgl1}}
                                            Dokter/Bidan/pemeriksan




                                            {{$sur->dokter}}
            </pre>
          
            @endforeach
        </tbody>
    </table>
</body>

</html>