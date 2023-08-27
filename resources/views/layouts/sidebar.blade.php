<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title) ? $title : 'Title tidak diatur' }}</title>
    <script src="https://kit.fontawesome.com/a284c48079.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
            <img src="{{asset('logo-puskesmas.png')}}" alt="">
            <div class="sidebar-brand" style="margin-top: -20%">
                <h1>
                    <span>PUSKESMAS BERUNTUNG RAYA</span>
                </h1>
            </div>
            <div class="sidebar-menu">
                <ul>
                    @if(Auth::user()->level =='operator')
                    <a class="dropdown-btn">Master
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-container" style="display: inline">
                       
                        <a href="{{ url('dashboard/dashboard?tgl='.date('Y-m-d').'&tahun='.date('Y').'&dari='.date('Y-m-d').'&sampai='.date('Y-m-d').'') }}"
                            class="{{ request()->is('dashboard/*','apotek','admin','rekam')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                        
                        <a href="{{ url('pengguna/pengguna') }}"
                            class="{{ request()->is('pengguna/pengguna*','pengguna/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Pengguna</span>
                        </a>

                        <a href="{{ url('kapuskes/kapuskes') }}"
                            class="{{ request()->is('kapuskes/kapuskes*','kapuskes/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Kapus</span>
                        </a>
                    
                        <a href="{{ url('pegawai/pegawai') }}"
                            class="{{ request()->is('pegawai/pegawai*','pegawai/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Pegawai</span>
                        </a>
                    
                        <a href="{{ url('petugas/petugas?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('petugas/petugas*','petugas/*')?'active' :'' }}">
                            <span class="fa-solid fa-user-doctor"></span>
                            <span>Petugas</span>
                        </a>
                    
                        <a href="{{ url('pasien/pasien') }}"
                            class="{{ request()->is('pasien/pasien','pasien/*')?'active' :'' }}">
                            <span class="las la-users"></span>
                            <span>Pasien</span>
                        </a>
                    
                        <a href="{{ url('medis/medis?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('medis/*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Rekam Medis</span>
                        </a>
                    
                        <a href="{{ url('resep/resep?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('resep/resep*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Resep</span>
                        </a>
                    
                        <a href="{{url('obat/obat')}}" class="{{ request()->is('obat/obat')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat</span>
                        </a>
                    
                        <a href="{{url('obat/obatkeluar?tgl='.date('Y-m-d').'')}}"
                            class="{{ request()->is('obat/obatkeluar')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Keluar</span>
                        </a>
                    
                        <a href="{{url('obat/masuk?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('obat/masuk')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Masuk</span>
                        </a>
                    </div>
                    </li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/kapus')}}"
                                class="{{ request()->is('laporan/kapus')?'active' :'' }}">Kapus</a>
                            <a href="{{url('laporan/pegawai')}}"
                                class="{{ request()->is('laporan/pegawai')?'active' :'' }}">Pegawai</a>
                            <a href="{{url('laporan/petugas')}}"
                                class="{{ request()->is('laporan/petugas')?'active' :'' }}">Petugas</a>
                            <a href="{{url('laporan/jadwal?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/jadwal')?'active' :'' }}">Jadwal</a>
                            <a href="{{url('laporan/pasien')}}"
                                class="{{ request()->is('laporan/pasien')?'active' :'' }}">Pasien</a>
                            <a href="{{url('laporan/medis?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/medis')?'active' :'' }}">Berobat</a>
                            <a href="{{url('laporan/biaya?cari='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/biaya')?'active' :'' }}">Biaya</a>
                            <a href="{{url('laporan/obat')}}"
                                class="{{ request()->is('laporan/obat')?'active' :'' }}">Obat</a>
                            <a href="{{url('laporan/obat_masuk?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/obat_masuk')?'active' :'' }}">Obat masuk</a>
                            <a href="{{url('laporan/obat_keluar?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/obat_keluar')?'active' :'' }}">Obat Keluar</a>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->level =='admin')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('Y-m-d').'&tahun='.date('Y').'&dari='.date('Y-m-d').'&sampai='.date('Y-m-d').'') }}"
                            class="{{ request()->is('dashboard/dashboard?tgl='.date('Y-m-d').'','apotek','admin','rekam')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pegawai/pegawai') }}"
                            class="{{ request()->is('pegawai/pegawai*','pegawai/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('kapuskes/kapuskes') }}"
                            class="{{ request()->is('kapuskes/kapuskes*','kapuskes/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Kapus</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-btn" >
                            <span class="las la-users"></span>
                            <span>Pasien</span>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{ url('pasien/pasien?jenis=umum') }}">Umum</a>
                            <a href="{{ url('pasien/pasien?jenis=bpjs') }}">BPJS</a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ url('medis/medis?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('medis/*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Rekam Medis</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/kapus')}}"
                                class="{{ request()->is('laporan/kapus')?'active' :'' }}">Kapus</a>
                            <a href="{{url('laporan/pegawai')}}"
                                class="{{ request()->is('laporan/pegawai')?'active' :'' }}">Pegawai</a>
                            <a href="{{url('laporan/petugas')}}"
                                class="{{ request()->is('laporan/petugas')?'active' :'' }}">Petugas</a>
                            <a href="{{url('laporan/jadwal?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/jadwal')?'active' :'' }}">Jadwal</a>
                            <a href="{{url('laporan/pasien?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/pasien')?'active' :'' }}">Pasien</a>
                            <a href="{{url('laporan/medis?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/medis')?'active' :'' }}">Berobat</a>
                            <a href="{{url('laporan/biaya?cari='.date('Y-m-d').'&jenis=umum')}}"">Biaya UMUM</a>
                            <a href="{{url('laporan/biaya?cari='.date('Y-m-d').'&jenis=bpjs')}}"">Biaya BPJS</a>
                        </div>
                    </li>
                    {{-- <li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/pegawai')}}"
                                class="{{ request()->is('laporan/pegawai')?'active' :'' }}">Pegawai</a>
                            <a href="{{url('laporan/pasien?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/pasien')?'active' :'' }}">Pasien</a>
                            <a href="{{url('laporan/medis?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/medis')?'active' :'' }}">Berobat</a>
                            <a href="{{url('laporan/obat')}}"
                                class="{{ request()->is('laporan/obat')?'active' :'' }}">Obat</a>
                            <a href="{{url('laporan/obat_masuk?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/obat_masuk')?'active' :'' }}">Obat masuk</a>
                            <a href="{{url('laporan/obat_keluar?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/obat_keluar')?'active' :'' }}">Obat Keluar</a>
                        </div>
                    </li> --}}
                    @endif
                    @if(Auth::user()->level =='kapus')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('Y-m-d').'&tahun='.date('Y').'&dari='.date('Y-m-d').'&sampai='.date('Y-m-d').'') }}"
                            class="{{ request()->is('dashboard/dashboard?tgl='.date('Y-m-d').'','apotek','admin','rekam')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                               <span>dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/kapus') }}"
                            class="{{ request()->is('laporan/kapus*','kapuskes/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Kapus</span>
                        </a>    
                    </li>
                    <li>
                        <a href="{{ url('laporan/pegawai') }}"
                            class="{{ request()->is('laporan/pegawai*','pegawai/*')?'active' :'' }}">
                            <span class="las la-user-friends"></span>
                            <span>Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/petugas?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('laporan/petugas*','petugas/*')?'active' :'' }}">
                            <span class="fa-solid fa-user-doctor"></span>
                            <span>Petugas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/jadwal?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('laporan/jadwal*','jadwal/*')?'active' :'' }}">
                            <span class="fa-solid fa-user-doctor"></span>
                            <span>Jadwal petugas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/pasien') }}"
                            class="{{ request()->is('laporan/pasien','pasien/*')?'active' :'' }}">
                            <span class="las la-users"></span>
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/medis?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('laporan/medis*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Rekam Medis</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan/biaya?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('laporan/biaya*')?'active' :'' }}">
                            <span class="fa-solid fa-dollar-sign"></span>
                            <span>Biaya</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('laporan/obat')}}" class="{{ request()->is('laporan/obat')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('laporan/obat_keluar?tgl='.date('Y-m-d').'')}}"
                            class="{{ request()->is('laporan/obat_keluar')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Keluar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('laporan/obat_masuk?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('laporan/obat_masuk')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Masuk</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->level =='rekam_medis')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('Y-m-d').'&tahun='.date('Y').'&dari='.date('Y-m-d').'&sampai='.date('Y-m-d').'') }}"
                            class="{{ request()->is('dashboard/dashboard?tgl='.date('Y-m-d').'','apotek','admin','rekam')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->status == 0)
                    <li>
                        <a href="{{ url('petugas/tambah_dokter') }}"
                            class="{{ request()->is('petugas/petugas*','petugas/*')?'active' :'' }}">
                            <span class="fa-solid fa-user-doctor"></span>
                            <span>Petugas</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->status == 1)
                    <li>
                        <a href="{{ url('petugas/petugas?tgl='.date('Y-m-d').'') }}"
                            class="{{ request()->is('petugas/petugas*','petugas/*')?'active' :'' }}">
                            <span class="fa-solid fa-user-doctor"></span>
                            <span>Petugas</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ url('pasien/pasien') }}"
                            class="{{ request()->is('pasien/pasien','pasien/*')?'active' :'' }}">
                            <span class="las la-users"></span>
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medis/medis?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('medis/*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Rekam Medis</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/petugas')}}"
                                class="{{ request()->is('laporan/petugas')?'active' :'' }}">Petugas</a>
                            <a href="{{url('laporan/jadwal?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/jadwal')?'active' :'' }}">Jadwal</a>
                            <a href="{{url('laporan/pasien?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/pasien')?'active' :'' }}">Pasien</a>
                            <a href="{{url('laporan/medis?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/medis')?'active' :'' }}">Berobat</a>
                        </div>
                    </li>
                    @endif
                    @if(Auth::user()->level =='apotek')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('Y-m-d').'&tahun='.date('Y').'&dari='.date('Y-m-d').'&sampai='.date('Y-m-d').'') }}"
                            class="{{ request()->is('dashboard/dashboard?tgl='.date('Y-m-d').'','apotek','admin','rekam')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('resep/resep?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('resep/resep*','medis/rekam_medis*')?'active' :'' }}">
                            <span class="las la-book-medical"></span>
                            <span>Resep</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('obat/obat')}}" class="{{ request()->is('obat/obat')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('obat/obatkeluar?tgl='.date('Y-m-d').'')}}"
                            class="{{ request()->is('obat/obatkeluar')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Keluar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('obat/masuk?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('obat/masuk')?'active' :'' }}">
                            <span class="las la-capsules"></span>
                            <span>Obat Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/obat')}}"
                                class="{{ request()->is('laporan/obat')?'active' :'' }}">Obat</a>
                            <a href="{{url('laporan/obat_masuk?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/obat_masuk')?'active' :'' }}">Obat masuk</a>
                            <a href="{{url('laporan/obat_keluar?tgl='.date('Y-m-d').'')}}"
                                class="{{ request()->is('laporan/obat_keluar')?'active' :'' }}">Obat Keluar</a>
                        </div>
                    </li>
                    {{-- <li>
                        <a class="dropdown-btn">Laporan
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('laporan/pegawai')}}"
                                class="{{ request()->is('laporan/pegawai')?'active' :'' }}">Pegawai</a>
                            <a href="{{url('laporan/pasien?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/pasien')?'active' :'' }}">Pasien</a>
                            <a href="{{url('laporan/medis?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/medis')?'active' :'' }}">Berobat</a>
                            <a href="{{url('laporan/obat')}}"
                                class="{{ request()->is('laporan/obat')?'active' :'' }}">Obat</a>
                            <a href="{{url('laporan/obat_masuk?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/obat_masuk')?'active' :'' }}">Obat masuk</a>
                            <a href="{{url('laporan/obat_keluar?tgl='.date('d-m-Y').'')}}"
                                class="{{ request()->is('laporan/obat_keluar')?'active' :'' }}">Obat Keluar</a>
                        </div>
                    </li> --}}
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-content">
            <header>
                <h1>
                    <label for="nav-toggle" >
                        <span class="las la-bars" style="color: black"></span>
                    </label>
                    {{
        
                    isset($title) ? $title : 'Title tidak diatur'
                    
                    }}
                </h1>
                <div>
                    {{ Auth::user()->name }}

                    <a href="{{ route('logout') }}">Logout</a>

                </div>

            </header>
            <main>
                @yield('content')
            </main>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
</body>

</html>