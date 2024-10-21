<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warung Madura</title>
    {{-- {{asset()}} : mengambil file yang afa fi folder public --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">W'M</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    {{-- Pemnggilan href/link :
                        1. path (/) jika name route tidak di setting
                        2. pake {{route('nama')}} jika routenya sudah diset namenya
                    --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }}" aria-current="page"
                            href="/">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::is('obat.tambah') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Barang
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=" {{ route('obat.data') }} ">Data Barang</a></li>
                            <li><a class="dropdown-item " href="{{ route('obat.tambah') }}">Tambah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                <a class="nav-link" aria-current="true" href="{{ route('kelola.akun') }}">Kelola Akun</a>
                    </li>
                </ul>

            </div>
            <form class="d-flex" action="{{ route('obat.data') }}" role="search" method="GET">
                <input class="form-control ms-2 " type="text" placeholder="Search" aria-label="Search"
                    name="search_obat">
                <button class="btn btn-info text-white ms-2" type="submit">Search</button>
            </form>

            <form class="d-flex" action="{{ route('obat.data') }}" role="search" method="GET">
                <input type="hidden" name="sort_stock" value="stock">
                <button type="submit" class="btn btn-warning text-white ms-2">Urutkan Stok</button>
            </form>
            <form class="d-flex" action="{{ route('obat.data') }}" role="search" method="GET">
                <input type="hidden" name="asort_stock" value="stock">
                <button type="submit" class="btn btn-success text-white ms-2">Urutkan Stok Kebalik</button>
            </form>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>
