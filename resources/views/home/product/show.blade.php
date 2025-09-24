@extends('layouts.frontend.master')

@section('title', $products->title . ' - Detail Produk')

@section('content')
    <section class="container-xl mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.products.index') }}" class="text-decoration-none">Daftar
                        Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($products->title, 50) }}</li>

            </ol>
        </nav>
    </section>

    <section class="container-xl my-4">
        {{-- Menampilkan pesan sukses --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Menampilkan pesan error --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row gx-4">
            <div class="col-lg-9 mb-3">
                <div class="card card-body shadow-sm border-0 p-4 mb-4">
                    <div class="row gx-5">
                        {{-- Gambar Produk --}}
                        <div class="col-lg-4">
                            @if ($products->image)
                                <img src="{{ asset('storage/' . $products->image) }}" class="img-fluid rounded"
                                    alt="{{ $products->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-muted rounded"
                                    style="height: 400px;">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- Detail Produk dan Aksi --}}
                        <div class="col-lg-8">

                            <h1 class="h3 fw-bold mb-2">{{ $products->title }}</h1>
                            <p class="text-muted small mb-3">SKU: {{ $products->sku ?? 'N/A' }} | Dilihat: XX</p>

                            @php
                                $finalPrice = $products->price;
                                $discountPercentage = $products->discount; // sudah dalam bentuk persen (misal: 30)
                                if ($discountPercentage > 0) {
                                    $discountAmount = $products->price * ($discountPercentage / 100);
                                    $finalPrice = $products->price - $discountAmount;
                                }
                            @endphp

                            @if ($products->discount > 0)
                                <div class="d-flex align-items-center mb-1">
                                    <span class="badge bg-danger fs-6 me-2">{{ number_format($products->discount, 0) }}%
                                        OFF</span>
                                    <s class="text-muted fs-6">Rp{{ number_format($products->price, 0, ',', '.') }}</s>
                                </div>
                                <h2 class="text-success fw-bold display-5 mb-3">
                                    Rp{{ number_format($finalPrice, 0, ',', '.') }}
                                </h2>
                            @else
                                <h2 class="text-success fw-bold display-5 mb-3">
                                    Rp{{ number_format($products->price, 0, ',', '.') }}
                                </h2>
                            @endif

                            <div class="mb-3">
                                <p class="fw-semibold mb-1">Deskripsi Produk:</p>
                                <div class="text-break">
                                    {!! $products->description !!}
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="fw-semibold mb-1">Stok:</p>
                                    <span
                                        class="badge {{ $products->stock > 0 ? 'bg-info' : 'bg-danger' }} fs-6">{{ $products->stock > 0 ? $products->stock . ' Tersedia' : 'Stok Habis' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-semibold mb-1">Jenis Produk:</p>
                                    <span
                                        class="badge bg-secondary fs-6">{{ $products->jenis->name ?? 'Tidak Ada' }}</span>

                                </div>
                            </div>
                            <hr>
                            {{-- Tombol Aksi --}}
                            <div class="d-flex gap-2">
                                {{-- KOREKSI UTAMA ADA DI SINI: action form mengarah ke cart.add --}}
                                <form action="{{ route('cart.add', $products->slug) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    {{-- Anda mungkin ingin menambahkan input kuantitas di sini jika tidak selalu 1 --}}
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-success py-3 w-100"
                                        @if ($products->stock == 0) disabled @endif>
                                        <i class="bi bi-cart-plus me-2"></i>
                                        {{ $products->stock == 0 ? 'Stok Habis' : 'Tambahkan ke Keranjang' }}
                                    </button>
                                </form>
                                <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary flex-grow-1 py-3">
                                    <i class="bi bi-bag-check me-2"></i> Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 mb-3">
                <div class="card shadow-sm border-0 p-3"> {{-- Wrap sidebar content in a card --}}
                    <h5 class="fw-bold">Produk Terkait</h5>
                    <hr class="mb-4">
                    <div class="row">
                        @forelse ($relatedProducts as $related)
                            <div class="col-12 mb-3">
                                <a href="{{ route('home.products.show', $related->slug) }}"
                                    class="card h-100 shadow-sm border-0 text-decoration-none text-dark position-relative overflow-hidden">
                                    @if ($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" class="img-fluid rounded-top"
                                            alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-muted rounded-top"
                                            style="height: 150px;">
                                            No Image
                                        </div>
                                    @endif

                                    <div class="card-body p-3">
                                        <h6 class="card-title fw-semibold mb-1">{{ Str::limit($related->title, 40) }}</h6>
                                        @php
                                            $relatedFinalPrice = $related->price;
                                            $relatedDiscountPercentage = $related->discount;
                                            if ($relatedDiscountPercentage > 0) {
                                                $relatedDiscountAmount =
                                                    $related->price * ($relatedDiscountPercentage / 100);
                                                $relatedFinalPrice = $related->price - $relatedDiscountAmount;
                                            }
                                        @endphp

                                        @if ($related->discount > 0)
                                            <p class="card-text mb-0">
                                                <span class="badge bg-danger me-1">{{ $related->discount }}% OFF</span>
                                                <s
                                                    class="text-muted small">Rp{{ number_format($related->price, 0, ',', '.') }}</s>
                                            </p>
                                            <p class="card-text text-success fw-bold">
                                                Rp{{ number_format($relatedFinalPrice, 0, ',', '.') }}
                                            </p>
                                        @else
                                            <p class="card-text text-success fw-bold">
                                                Rp{{ number_format($related->price, 0, ',', '.') }}
                                            </p>
                                        @endif

                                        <small class="text-body-secondary d-block mt-2">Stok: {{ $related->stock }}</small>
                                        {{-- Link 'Lihat Detail' tidak perlu button karena seluruh card sudah clickable --}}
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center" role="alert">
                                    Tidak ada produk terkait yang ditemukan.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
