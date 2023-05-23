<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <img src="{{asset('logo-puskesmas.png')}}" style="padding-left: 20px; padding-top: 8px" height="50px" alt="">
        <div class="nav1">
            <div class="logo">
                <a href="#">
                    <p>Puskesmas Beruntung Raya</p>
                </a>
            </div>
            <ul>
                <li class="active">Home</li>
                <li>Food</li>
                <li>Hotel</li>
                <li>About</li>
                <a href="/login" style="color: white; text-decoration: none">Login</a>
            </ul>
        </div>

        <div class="content-header">
            <form class="form card" style="background: linear-gradient(to right, #116ea4, #1799c8);" action="{{route('riwayat/riwayat')}}" method="GET">
                <img src="{{asset('logo-puskesmas.png')}}" alt="">
                    <hr>
                    <div class="card_header">
                        <h1 class="form_heading">Cek data pasien dan rekam medis</h1>
                    </div>
                    <div class="mb-3">
                        <label style="color: rgb(255, 255, 255)">NIK <span class="text-danger">*</span></label>
                        <input class="input" type="text" name="nik" />
                    </div>
                    <div class="mb-3">
                        <label style="color: rgb(255, 255, 255)">Password <span class="text-danger">*</span></label>
                        <input class="input" type="text" name="password" />
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-12">
                            <button class="btn btn-success col-12">PROSES</button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="col-img" style="">
            <img src="{{asset('css/puskesmas.png')}}" alt="">
        </div>

    </div>
</body>
</html>