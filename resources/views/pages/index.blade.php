@extends('layouts.layout')

@section('content')
    <!-- Jumbotron -->
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="text-center p-5 card w-75">
            <h1 class="display-4">Selamat Datang di Warung Madura</h1>
            <h5 class="mt-2">Kami menyediakan berbagai macam produk. Mulai dari Makanan hingga obat-obatan. <br> Juga menyediakan fasilitas warung yang buka 24 jam.</h5>
            <img class="w-25 h-25 rounded mx-auto d-block mt-3 mb-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2eW3ul8WPH1Je_uW40fmlC-WEq7-KBGzCXQ&s" alt="">
            <hr class="my-4">
            <h5>Temukan produk yang anda butuhkan dengan harga terjangkau dan ekonomis .</h5>
            <a class="btn btn-info text-white btn-lg mt-3" href=" {{ route('obat.data') }} " role="button">Lihat Produk</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-qCzm8Ivof4vZeF1TwzFQl6XY/EGNw+DaZQTI2goe/jCfmFY6y+DsctA4EY1dl2Jq" crossorigin="anonymous"></script>
@endsection
