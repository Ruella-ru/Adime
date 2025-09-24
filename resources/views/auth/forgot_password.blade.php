<!doctype html>
<html lang="en">

<head>
    @include('layouts.frontend.head')
    @include('layouts.frontend.style')
    @vite([])
</head>

<body>
    <main class="flex-grow-1 py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">
                    <div class="card shadow px-4 py-4">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4 d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    class="text-primary me-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-files me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                    <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                </svg>
                                <span>MyBlog</span>
                            </h2>

                            <form action="{{ route('password.email') }}" method="POST" autocomplete="off" novalidate>
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label">Masukkan email anda:</label>
                                    <input type="email" name="email" placeholder="email@example.com"
                                        class="form-control" required>
                                </div>

                                @if (session('status'))
                                    <p>{{ session('status') }}</p>
                                @endif

                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="form-footer d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column gap-2">
                                        <a href="/login" style="text-decoration: none; color: #3A7CA5;">Kembali</a>
                                    </div>
                                    <button type="submit" class="btn text-white px-4"
                                        style="background-color: #3A7CA5;">Kirim</button>
                                </div>

                            </form>
