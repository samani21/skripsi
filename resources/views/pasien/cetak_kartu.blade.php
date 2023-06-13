<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <pre>
    <h2>          Kartu Berobat</h2>
    <b>     No Kartu</b>      : <?php if($kartu->no_berobat <= '9'){ 
        echo '000',$kartu->no_berobat;} ?>

    <b>     NIK</b>           : {{$kartu->nik}}
    <b>     Nama</b>          : {{$kartu->nama}}
    <b>     TTL</b>           : {{$kartu->tempat}},<?php echo date('d-m-Y', strtotime($kartu->tgl));?>

    <b>     Alamat</b>        : {{$kartu->alamat}}
    <b>     Jenis Kelamin</b> : {{$kartu->jk}}
    </pre>
</body>
</html>
