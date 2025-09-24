<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adime | Informasi Anime Terkini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f0f2f5;
            /* Warna latar belakang ringan */
        }

        .navbar {
            background-color: #2c3e50;
            /* Warna navbar gelap */
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #ecf0f1 !important;
            /* Warna teks navbar */
        }

        .hero-section {
            background: url('https://wallpapercave.com/wp/wp6600435.jpg') no-repeat center center/cover;
            /* Ganti dengan gambar anime */
            color: white;
            padding: 100px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .anime-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            height: 100%;
            /* Pastikan tinggi kartu seragam */
            display: flex;
            flex-direction: column;
        }

        .anime-card:hover {
            transform: translateY(-5px);
        }

        .anime-card .card-body {
            flex-grow: 1;
            /* Biarkan konten mengisi sisa ruang */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .anime-card .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .footer {
            background-color: #34495e;
            /* Warna footer gelap */
            color: white;
            padding: 40px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-list me-3"></i>Adime</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="anime_terbaru.html">Anime Terbaru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./berita_terbaru.html">Berita Terbaru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about_me.html">About Me</a>
                    </li>

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-primary" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    {{ __('Dashboard') }}
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Jelajahi Dunia Anime Bersama Kami!</h1>
            <p class="lead">Temukan informasi terkini, ulasan, dan detail lengkap tentang anime favorit Anda.</p>
        </div>
    </header>

    <main class="container my-5">

        <section id="anime-terbaru" class="mb-5">
            <h2 class="text-center mb-4">Anime Populer</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="card anime-card">
                        <img src="https://static0.gamerantimages.com/wordpress/wp-content/uploads/2023/09/one-piece-9.jpg"
                            class="card-img-top" alt="One Piece">
                        <div class="card-body">
                            <h5 class="card-title">One Piece</h5>
                            <p class="card-text">Genre: Aksi, Petualangan</p>
                            <p class="card-text">Status: Tayang</p>
                            <a href="#" class="btn btn-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card anime-card">
                        <img src="https://tse1.mm.bing.net/th/id/OIP.VEkk-fo4WM8R_Rf4A_P8xwHaLH?r=0&rs=1&pid=ImgDetMain&o=7&rm=3"
                            class="card-img-top" alt="Judul Anime 2">
                        <div class="card-body">
                            <h5 class="card-title">Black Clover</h5>
                            <p class="card-text">Genre: Fantasi, Slice of Life</p>
                            <p class="card-text">Status: Tayang</p>
                            <a href="#" class="btn btn-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card anime-card">
                        <img src="https://cdn.kobo.com/book-images/52f5141b-1237-4e0a-85a5-44e469338733/1200/1200/False/overlord-vol-18-manga.jpg"
                            class="card-img-top" alt="Judul Anime 3">
                        <div class="card-body">
                            <h5 class="card-title">Overlord</h5>
                            <p class="card-text">Genre: Romantis, Komedi</p>
                            <p class="card-text">Status: Selesai</p>
                            <a href="#" class="btn btn-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card anime-card">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.MJWp6UMTK_CFnik7gNrslwHaKf?r=0&w=1130&h=1600&rs=1&pid=ImgDetMain&o=7&rm=3"
                            class="card-img-top" alt="Judul Anime 4">
                        <div class="card-body">
                            <h5 class="card-title">Tensei Shitara Slime Datta ken</h5>
                            <p class="card-text">Genre: Sci-Fi, Thriller</p>
                            <p class="card-text">Status: Tayang</p>
                            <a href="#" class="btn btn-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="./anime_terbaru.html" class="btn btn-outline-primary">Lihat Semua Anime Terbaru</a>
            </div>


        </section>

    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2025 AnimeHub. Semua Hak Dilindungi.</p>
            <p>Dibuat dengan ❤️ dan Bootstrap</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK"
        crossorigin="anonymous"></script>
</body>

</html>