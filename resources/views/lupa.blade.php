<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body style="background-color: rgb(185, 200, 241)">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-transparant shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    PUSKESMAS BERUNTUNG RAYA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @if(session('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                        @endif
                        <div class="form card" style="background-color: rgb(229, 231, 235)">
                            <div class="card_header">
                                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"
                                        fill="currentColor"></path>
                                </svg>
                                <h1 class="form_heading">Lupa Password</h1>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <form action="{{route('lupa')}}" method="GET">
                                        <label>Cari email <span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col-10">
                                                <input class="form-control" type="text" name="email" />
                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-primary mb-3">Cari</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @foreach($u as $user)
                            <form action="{{ route('reset.action',$user->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <input type="hidden" name="name" value="{{$user->name}}">
                                <input type="hidden" name="email_verified_at" value="{{$user->email_verified_at}}">
                                <input type="hidden" name="level" value="{{$user->level}}">
                                <input type="hidden" name="remember_token" value="{{$user->remember_token}}">
                                <div>
                                    <label for="">Email</label>
                                    <input class="form-control" type="text" name="email" value="{{$user->email}}"
                                        readonly />
                                </div>
                                <div>
                                    <label for="">Username</label>
                                    <input class="form-control" type="text" name="username" value="{{$user->username}}"
                                        readonly />
                                </div>
                                <div>
                                    <label for="">Password baru</label>
                                    <input class="form-control" type="password" name="password" autofocus />
                                </div>
                                <br>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                    <a class="btn btn-danger" href="{{ route('login') }}">Back</a>
                                </div>
                            </form>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
</body>

</html>