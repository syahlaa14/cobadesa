<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi Profil Desa Pasir Kulon. Informasi sejarah, statistik, aparatur desa, destinasi wisata, dan layanan publik mandiri online.">
    <meta name="keywords" content="Desa Pasir Kulon, Profil Desa, Wisata Desa, Layanan Desa Online, Pemerintahan Desa">
    <meta name="author" content="Pemerintah Desa Pasir Kulon">
    
    <!-- CSRF Token for Laravel Security -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Desa Pasir Kulon - Harmoni Alam dan Kemajuan Teknologi</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/desa_hero_banner.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS served via asset helper -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="main-header" id="mainHeader">
        <div class="container header-container">
            <a href="#home" class="logo" id="logoLink">
                <i class="fa-solid fa-mountain-sun logo-icon"></i>
                <span class="logo-text">Pasir<span>Kulon</span></span>
            </a>
            
            <nav class="nav-menu" id="navMenu" aria-label="Navigasi Utama">
                <ul class="nav-list">
                    <li><a href="#home" class="nav-link active">Beranda</a></li>
                    <li><a href="#about" class="nav-link">Tentang Kami</a></li>
                    <li><a href="#stats" class="nav-link">Statistik</a></li>
                    <li><a href="#apparatus" class="nav-link">Aparatur</a></li>
                    <li><a href="#services" class="nav-link">Layanan Publik</a></li>
                    <li><a href="#contact" class="nav-link">Hubungi Kami</a></li>
                </ul>
            </nav>
            
            <button class="mobile-toggle" id="mobileToggle" aria-label="Buka Menu" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </header>

    <!-- Main Content Yield -->
    <main>
        @yield('content')
    </main>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container footer-container">
            <div class="footer-brand">
                <a href="#home" class="logo">
                    <i class="fa-solid fa-mountain-sun logo-icon"></i>
                    <span class="logo-text">Pasir<span>Kulon</span></span>
                </a>
                <p>Membangun dengan teknologi modern tanpa melupakan keindahan akar tradisi dan kelestarian alam nusantara.</p>
                <div class="footer-socials">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            
            <div class="footer-links">
                <h4>Navigasi Cepat</h4>
                <ul>
                    <li><a href="#home"><i class="fa-solid fa-angle-right"></i> Beranda</a></li>
                    <li><a href="#about"><i class="fa-solid fa-angle-right"></i> Tentang Kami</a></li>
                    <li><a href="#stats"><i class="fa-solid fa-angle-right"></i> Statistik Desa</a></li>
                    <li><a href="#apparatus"><i class="fa-solid fa-angle-right"></i> Aparatur Desa</a></li>
                    <li><a href="#news-events"><i class="fa-solid fa-angle-right"></i> Berita & Kegiatan</a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h4>Layanan Mandiri</h4>
                <ul>
                    <li><a href="#services"><i class="fa-solid fa-angle-right"></i> Surat Keterangan Usaha</a></li>
                    <li><a href="#services"><i class="fa-solid fa-angle-right"></i> Surat Ket. Tidak Mampu</a></li>
                    <li><a href="#services"><i class="fa-solid fa-angle-right"></i> Surat Pengantar Umum</a></li>
                    <li><a href="#contact"><i class="fa-solid fa-angle-right"></i> Hubungi Call Center</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} Pemerintah Desa Pasir Kulon. Seluruh Hak Cipta Dilindungi. <br>Dikembangkan dengan dedikasi untuk melayani warga.</p>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript served via asset helper -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
