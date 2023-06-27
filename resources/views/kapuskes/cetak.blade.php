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
    <h3 align="center">LAPORAN DATA KAPUS</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='80'>NIP</th>
                <th width='80'>Nama</th>
                <th width='70'>Mulai</th>
                <th width='70'>Selesai</th>
                <th width='70'>Lama menjabat</th>
                <th width='100'>Status</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
            @foreach($kapus as $kap)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{$kap->nip}}</td>
                    <td style="text-transform: uppercase">{{$kap->nama}}</td>
                    <td>{{$kap->tgl_mulai}}</td>
                    <td>{{$kap->tgl_selesai}}</td>
                    <td> <?php 
                    if($kap->tgl_selesai == '-'){
                        echo "-";
                    }else {
                        ?>
                        @php
                        $tgl_mulai = $kap->tgl_mulai;
                        $jabat = new DateTime($tgl_mulai);
                        $tgl_selesai = new DateTime($kap->tgl_selesai);
                        $lama_jabat = $tgl_selesai->diff($jabat);
                        @endphp
                        {{$lama_jabat->y." Tahun"." ". $lama_jabat->m ." Bulan"." ".$lama_jabat->d." hari"}}
                        <?php
                    }
                    ?>
                    </td>
                    <td data-title="Status"><?php
                        if ($kap->status == 0) {
                            echo "Selesai Menjabat";
                        }
                        if ($kap->status == 1) {
                            echo "Menjabat";
                        }
                        if ($kap->status == 2) {
                            echo "--Pilih--";
                        }
                    ?></td>
                    
                </tr>
            @endforeach
        </tbody>
        </table>
        <div>
            <pre align="right">
                                              Banjarmasin,{{$tgl}}




                            
                            @foreach ($kapu as $k )
                {{$k->nama}}
                                            {{$k->nip}}
                            @endforeach

                                                   
            </pre>
        </div>
</body>
</html>
