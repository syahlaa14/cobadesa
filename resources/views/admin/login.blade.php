<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Makmur Sentosa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-body">

    <div class="login-card">
        <div class="login-logo">
            <i class="fa-solid fa-mountain-sun"></i>
            <span>Makmur Admin</span>
        </div>
        <p class="login-subtitle">Masuk ke Panel Pengelolaan Sistem Desa</p>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="nama@domain.com" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                >
                @error('email')
                    <span class="form-error">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control" 
                    placeholder="Masukkan password Anda" 
                    required
                >
            </div>

            <!-- Remember Me -->
            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    style="accent-color: var(--accent-color); width: 16px; height: 16px; cursor: pointer;"
                >
                <label for="remember" class="form-label" style="margin-bottom: 0; cursor: pointer; user-select: none;">Ingat saya di perangkat ini</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
                <span>Masuk Sekarang</span>
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>

        <div style="margin-top: 24px; font-size: 0.8rem; color: var(--text-muted);">
            <a href="{{ route('home') }}" style="text-decoration: underline; hover: color: var(--text-primary);">
                <i class="fa-solid fa-house"></i> Kembali ke Beranda Utama
            </a>
        </div>
    </div>

</body>
</html>
