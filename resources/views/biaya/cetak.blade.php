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
    <h3 align="center">LAPORAN PEMASUKKAN</h3>
    <p>
        Periode : {{date('d-m-Y', strtotime($dari))}} / {{date('d-m-Y', strtotime($sampai))}}
    </p>
    <table align="center" style="border-collapse:collapse;border-spacing:1;" border="1">
        <thead>
            <tr align="center">
                <th width="20">No</th>
                <th width="40">No Berobat</th>
                <th width="100">Nama</th>
                <th width="60">Jenis Berobat</th>
                <th width="50">Poli</th>
                <th width="50">Biaya</th>
                <th width="60">status</th>
                <th width="80">Tanggal</th>
                

            </tr>
            </thead>
            <tbody>
                @php
            $no=1;
            @endphp
            @foreach($biaya as $index=>$b)
            <tr align="center">
                <td>{{ $index + $biaya->firstItem() }}</td>
                <td>{{$b->no_berobat}}</td>
                <td align="left">{{$b->nama}}</td>
                <td>{{$b->j_berobat}}</td>
                <td>{{$b->poli}}</td>
                <td>{{$b->biaya}}</td>
                <td>{{$b->status}}</td>
                <td>{{date('d-m-Y', strtotime($b->tgl))}}</td>
            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
    @if ($akun == "admin")
    <?php
    if ($a == 0) {
        ?>
        <div>
            <pre>
Jumlah Pasien : {{$pasien->count()}} Orang
    
Total Biaya Hari tanggl = Rp.@foreach ($total as $bi){{$bi->total}}@endforeach
            </pre>
        </div>
        <?php
    }
?>
    @endif
    @if ($akun == "operator")
    <?php
        if ($a == 0) {
            ?>
            <div>
                <pre>
    Jumlah Pasien BPJS : {{$p_bpjs->count()}} Orang
    Jumlah Pasien Umum : {{$p_umum->count()}} Orang
        
    Jumlah Biaya BPJS : Rp.@foreach ($b_bpjs as $umum){{$umum->total}}@endforeach
        
    Jumlah Biaya Umum : Rp.@foreach ($b_umum as $umum){{$umum->total}}@endforeach
        
    Total Biaya Hari tanggl = Rp.@foreach ($total as $bi){{$bi->total}}@endforeach
                </pre>
            </div>
            <?php
        }
    ?>
        
    @endif
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