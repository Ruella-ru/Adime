@extends('layouts.frontend.master')

@section('homeActive')
    text-primary
@endsection

@section('content')
    <main class="container my-5">

        <section id="anime-terbaru" class="mb-5">
            <h2 class="text-center mb-4">Anime Populer</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @forelse ($articles as $key => $val)
                    {{-- Skip the first article as it's used for featured --}}
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100 mb-3">
                            @if ($val->image)
                                <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                    <img class="card-img-top" src="{{ asset('storage/' . $val->image) }}" alt="..."
                                        style="object-fit: contain; width: 100%; height: 100%;">
                                </div>
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center text-white-50 ratio ratio-1x1"
                                    style=" background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
                                    No Image
                                </div>
                            @endif
                            <div class="card-body small d-flex flex-column">
                                <h5 class="card-title"><small>{{ $val->title }}</small></h5>
                                <p class="card-text flex-grow-1">
                                    <small>{{ Str::limit(strip_tags($val->meta_desc), 120) }}</small>
                                </p>
                                <a href="{{ route('home.articles.show', $val->slug) }}"
                                    class="btn btn-sm btn-primary mt-1 rounded-pill">Baca
                                    Artikel</a>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-muted">Diperbaharui:
                                    {{ $val->updated_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            Belum ada artikel yang tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="./anime_terbaru.html" class="btn btn-outline-primary">Lihat Semua Anime Terbaru</a>
            </div>
        </section>

        <section>
            <hr class="my-5">
            <div class="row gx-4">
                <h4 class="mb-4 fw-bold text-center">Products Terbaru</h4>
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        @forelse ($products as $key => $val)
                            {{-- Skip the first article as it's used for featured --}}
                            <div class="col-md-3 mb-4">
                                <div class="card shadow-sm border-0 h-100 mb-3">
                                    @if ($val->image)
                                        <div
                                            class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                            <img class="card-img-top" src="{{ asset('storage/' . $val->image) }}"
                                                alt="..." style="object-fit: contain; width: 100%; height: 100%;">
                                        </div>
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center text-white-50 ratio ratio-1x1"
                                            style=" background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
                                            No Image
                                        </div>
                                    @endif

                                    <div class="card-body small d-flex flex-column">
                                        <h5 class="card-title"><small>{{ $val->title }}</small></h5>
                                        <p class="card-text flex-grow-1">
                                            <small>{{ Str::limit(strip_tags($val->meta_desc), 120) }}</small>
                                        </p>
                                        <a href="{{ route('home.products.show', $val->slug) }}"
                                            class="btn btn-sm btn-primary mt-1 rounded-pill">Baca
                                            Product</a>
                                    </div>
                                    <div class="card-footer text-center">
                                        <small class="text-muted">Diperbaharui:
                                            {{ $val->updated_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center" role="alert">
                                    Belum ada product yang tersedia.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
        </section>
    </main>
@endsection
