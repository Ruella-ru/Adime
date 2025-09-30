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
                                <span>Adime</span>
                            </h2>
                            <hr>
                            <p class="text-center text-muted mb-4">Login ke Akun Anda</p>

                            <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" placeholder="your@email.com"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" placeholder="Your password"
                                        value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                                </div>
                            </form>
                            <div class="text-center text-secondary mt-3 d-flex flex-column">
                                <a href="{{ route('register') }}" class="text-decoration-none" tabindex="-1">Belum
                                    punya akun?</a>
                                <a href="/forgot-password" style="text-decoration: none;">Lupa
                                    password?</a>
                            </div>
                            <hr>
                            <div class="text-center text-secondary mt-3">
                                Kembali ke halaman <a href="/" class="text-decoration-none"
                                    tabindex="-1">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.frontend.script')

</body>

</html>
