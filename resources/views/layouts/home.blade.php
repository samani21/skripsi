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
            {{-- <ul>
                <li class="{{ request()->is('/')?'active' :'' }}">
                    <a href="{{url('/')}}"style="color: white; text-decoration: none">
                    Home
                    </a>
                </li>
                <li class="{{ request()->is('visi')?'active' :'' }}">
                    <a href="{{url('/visi')}}"style="color: white; text-decoration: none">
                    Visi & Misi
                    </a>
                </li> --}}
                {{-- <li class="{{ request()->is('berita')?'active' :'' }}">
                    <a href="{{url('/berita')}}"style="color: white; text-decoration: none">
                    Berita
                    </a>
                </li> --}}
                {{-- <li class="{{ request()->is('contact')?'active' :'' }}">
                    <a href="{{url('/contact')}}"style="color: white; text-decoration: none">
                    Contact
                    </a>
                </li>
                <a href="/login" style="color: white; text-decoration: none">Login</a> --}}
            </ul>
        </div>
        <main>
            @yield('content')
        </main>
</body>
</html>