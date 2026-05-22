@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" id="home" style="background-image: linear-gradient(rgba(17, 34, 25, 0.45), rgba(17, 34, 25, 0.85)), url('{{ asset('images/desa_hero_banner.png') }}');">
        <div class="container hero-container">
            <div class="hero-badge animate-fade-in">
                <i class="fa-solid fa-leaf"></i> Selamat Datang di Desa Makmur Sentosa
            </div>
            <h1 class="hero-title animate-fade-in-up">Harmoni Alam & <br><span class="highlight">Kemajuan Teknologi</span></h1>
            <p class="hero-subtitle animate-fade-in-up">Mewujudkan desa agraris mandiri, cerdas, sejahtera, dan melestarikan kearifan lokal berlandaskan semangat gotong royong.</p>
            <div class="hero-actions animate-fade-in-up">
                <a href="#tourism" class="btn btn-primary" id="btnExplore">
                    <span>Jelajahi Desa</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="#services" class="btn btn-secondary" id="btnServices">
                    <span>Layanan Mandiri</span>
                    <i class="fa-solid fa-file-invoice"></i>
                </a>
            </div>
        </div>
        
        <!-- Floating Wave Divider -->
        <div class="wave-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,42.4V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- About Section (Profil & Visi Misi) -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Profil Desa</span>
                <h2 class="section-title">Sekilas Makmur Sentosa</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="about-grid">
                <div class="about-info-card card-glow">
                    <h3>Sejarah & Letak Geografis</h3>
                    <p>Desa Makmur Sentosa berdiri sejak tahun 1954 di kaki lembah pegunungan yang subur. Terkenal dengan sistem pengairan subak mandiri dan hasil bumi yang melimpah, desa kami kini bertransformasi menjadi <strong>"Smart Village"</strong> percontohan nasional.</p>
                    <p>Kami menggabungkan kelestarian lingkungan pertanian dengan adopsi teknologi tepat guna untuk mengoptimalkan potensi pertanian, UMKM kreatif, dan ekowisata alam pedesaan yang menawan.</p>
                    <div class="about-features">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <div class="feature-text">
                                <h4>Aman & Damai</h4>
                                <p>Tingkat harmoni sosial tinggi dengan sistem gotong royong aktif.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fa-solid fa-seedling"></i></div>
                            <div class="feature-text">
                                <h4>Eco-Friendly</h4>
                                <p>Pengelolaan sampah terpadu dan konservasi lahan hijau.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="vision-mission-container">
                    <div class="vision-card">
                        <div class="vision-header">
                            <i class="fa-solid fa-eye vision-icon"></i>
                            <h3>Visi Kami</h3>
                        </div>
                        <p class="vision-text">"Menjadi pusat agro-wisata digital terdepan di Indonesia yang sejahtera, berbudaya luhur, mandiri secara ekonomi, dan lestari ekologinya pada tahun 2030."</p>
                    </div>
                    
                    <div class="mission-card">
                        <div class="mission-header">
                            <i class="fa-solid fa-list-check mission-icon"></i>
                            <h3>Misi Kami</h3>
                        </div>
                        <ul class="mission-list">
                            <li>
                                <span class="mission-num">01</span>
                                <span class="mission-desc">Mengembangkan teknologi pertanian presisi (*smart farming*) untuk kemandirian pangan.</span>
                            </li>
                            <li>
                                <span class="mission-num">02</span>
                                <span class="mission-desc">Meningkatkan kapasitas aparatur dan transparansi publik melalui sistem administrasi digital.</span>
                            </li>
                            <li>
                                <span class="mission-num">03</span>
                                <span class="mission-desc">Mengembangkan destinasi ekowisata berbasis komunitas demi kesejahteraan warga lokal.</span>
                            </li>
                            <li>
                                <span class="mission-num">04</span>
                                <span class="mission-desc">Menjaga kelestarian seni budaya tradisional dan nilai spiritual kearifan lokal.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section section-padding" id="stats">
        <div class="container">
            <div class="section-header text-center light-text">
                <span class="section-tagline">Data & Fakta</span>
                <h2 class="section-title">Statistik Kemajuan Desa</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="stats-grid" id="statsGrid">
                <!-- Stat Item 1 -->
                <div class="stat-card" data-target="4850">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix">+</span>
                    </div>
                    <p class="stat-label">Jumlah Penduduk (Jiwa)</p>
                </div>
                
                <!-- Stat Item 2 -->
                <div class="stat-card" data-target="720">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix"> Ha</span>
                    </div>
                    <p class="stat-label">Luas Wilayah Subur</p>
                </div>
                
                <!-- Stat Item 3 -->
                <div class="stat-card" data-target="1200">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix"> Ton</span>
                    </div>
                    <p class="stat-label">Hasil Panen Padi & Buah/Thn</p>
                </div>
                
                <!-- Stat Item 4 -->
                <div class="stat-card" data-target="45">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix">+</span>
                    </div>
                    <p class="stat-label">UMKM Kreatif Aktif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Apparatus Section (Rendered dynamically using Blade loops) -->
    <section class="apparatus-section section-padding" id="apparatus">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Pemerintahan</span>
                <h2 class="section-title">Aparatur Pemimpin Desa</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="apparatus-grid">
                @foreach ($apparatusList as $app)
                    <div class="apparatus-card card-glow">
                        <div class="apparatus-image-container">
                            <div class="avatar-placeholder"><i class="fa-solid {{ $app['icon'] }}"></i></div>
                            <div class="apparatus-socials">
                                <a href="{{ $app['facebook'] }}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="{{ $app['instagram'] }}" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a href="mailto:{{ $app['email'] }}" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="apparatus-info">
                            <h3>{{ $app['name'] }}</h3>
                            <span class="apparatus-role">{{ $app['role'] }}</span>
                            <p class="apparatus-desc">{{ $app['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tourism & Culture Section (Rendered dynamically using Blade loops) -->
    <section class="tourism-section section-padding" id="tourism">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Pesona Desa</span>
                <h2 class="section-title">Ekowisata & Budaya Lokal</h2>
                <div class="title-underline"></div>
            </div>
            
            <!-- Gallery Filters -->
            <div class="gallery-filters" id="galleryFilters">
                <button class="filter-btn active" data-filter="all">Semua Pesona</button>
                <button class="filter-btn" data-filter="nature">Wisata Alam</button>
                <button class="filter-btn" data-filter="culture">Seni & Budaya</button>
                <button class="filter-btn" data-filter="culinary">Kuliner Khas</button>
            </div>
            
            <!-- Gallery Grid -->
            <div class="gallery-grid" id="galleryGrid">
                @foreach ($tourismList as $tour)
                    <div class="gallery-item" data-category="{{ $tour['category'] }}">
                        <div class="gallery-inner card-glow">
                            <div class="gallery-image-wrapper">
                                <div class="gallery-placeholder {{ $tour['category'] }}"><i class="fa-solid {{ $tour['icon'] }}"></i></div>
                                <span class="gallery-badge">{{ $tour['category_label'] }}</span>
                            </div>
                            <div class="gallery-info">
                                <h3>{{ $tour['title'] }}</h3>
                                <p>{{ $tour['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Public Services Section (Interactive Document Generator) -->
    <section class="services-section section-padding" id="services">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Pelayanan Digital</span>
                <h2 class="section-title">Layanan Publik Mandiri</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="services-wrapper card-glow">
                <div class="services-intro text-center">
                    <p>Selamat datang di sistem <strong>E-Surat Mandiri</strong> Desa Makmur Sentosa. Anda dapat membuat rancangan draf surat keterangan umum secara instan di sini untuk mempercepat pengurusan berkas fisik di kantor desa.</p>
                </div>
                
                <div class="services-grid">
                    <!-- Service Selector & Form Panel -->
                    <div class="service-form-panel">
                        <div class="form-group">
                            <label for="serviceSelector"><i class="fa-solid fa-list-check form-icon"></i> Pilih Jenis Surat Keterangan:</label>
                            <select id="serviceSelector" class="form-control-select">
                                <option value="sku">Surat Keterangan Usaha (SKU)</option>
                                <option value="sktm">Surat Keterangan Tidak Mampu (SKTM)</option>
                                <option value="sp">Surat Pengantar Umum (Domisili / KTP)</option>
                            </select>
                        </div>
                        
                        <!-- Dynamic Input Form -->
                        <form id="docGeneratorForm" class="interactive-form">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="docName">Nama Lengkap:</label>
                                    <input type="text" id="docName" placeholder="Masukkan nama lengkap" required class="form-control-input">
                                </div>
                                <div class="form-group col">
                                    <label for="docNik">Nomor Induk Kependudukan (NIK):</label>
                                    <input type="text" id="docNik" placeholder="16 digit NIK Anda" maxlength="16" required class="form-control-input">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="docAddress">Alamat Lengkap (RT/RW/Dusun):</label>
                                <input type="text" id="docAddress" placeholder="Contoh: RT 03 / RW 01, Dusun Harapan" required class="form-control-input">
                            </div>
                            
                            <!-- Dynamic Content Field based on selection -->
                            <div class="form-group" id="dynamicFieldWrapper">
                                <label id="dynamicLabel" for="docDetail">Detail Usaha:</label>
                                <input type="text" id="docDetail" placeholder="Contoh: Toko Sembako dan Kelontong 'Maju Jaya'" required class="form-control-input">
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block" id="btnGenerate">
                                <i class="fa-solid fa-file-shield"></i> Buat Draf Surat
                            </button>
                        </form>
                    </div>
                    
                    <!-- Virtual Document Preview Panel -->
                    <div class="document-preview-panel">
                        <div class="preview-badge"><i class="fa-solid fa-circle-check"></i> Pratinjau Surat Real-time</div>
                        
                        <div class="letterhead-decor"></div>
                        <div class="virtual-letter" id="virtualLetter">
                            <!-- Header Surat -->
                            <div class="letter-header">
                                <i class="fa-solid fa-mountain-sun letter-logo"></i>
                                <div class="letter-header-text">
                                    <h4>PEMERINTAH KABUPATEN JAYA RAYA</h4>
                                    <h5>KECAMATAN HARAPAN INDAH</h5>
                                    <h3>KANTOR KEPALA DESA MAKMUR SENTOSA</h3>
                                    <p class="letter-sub">Jl. Raya Puncak No. 12, Kode Pos 40391 | Email: desa@makmursentosa.sch.id</p>
                                </div>
                            </div>
                            
                            <hr class="letter-divider">
                            
                            <!-- Judul Surat -->
                            <div class="letter-title">
                                <h4 id="prevTitle">SURAT KETERANGAN USAHA</h4>
                                <p>Nomor: 503 / <span id="prevNumber">142</span> / VIII / 2026</p>
                            </div>
                            
                            <!-- Isi Surat -->
                            <div class="letter-body">
                                <p>Yang bertanda tangan di bawah ini, Kepala Desa Makmur Sentosa, Kecamatan Harapan Indah, Kabupaten Jaya Raya, dengan ini menerangkan bahwa:</p>
                                
                                <table class="letter-table">
                                    <tr>
                                        <td style="width: 30%">Nama Lengkap</td>
                                        <td style="width: 5%">:</td>
                                        <td id="prevName" style="font-weight: bold;">Rian Hidayat</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td id="prevNik">3204123456780001</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="prevAddress">RT 02 / RW 04, Dusun Mawar Indah</td>
                                    </tr>
                                    <tr id="prevDynamicRow">
                                        <td id="prevDynamicLabel">Detail Usaha</td>
                                        <td>:</td>
                                        <td id="prevDynamicValue">Tani Sayur Organik Terpadu</td>
                                    </tr>
                                </table>
                                
                                <p id="prevClosing">Benar bahwa nama di atas memiliki usaha yang terdaftar di Desa Makmur Sentosa dan dalam keadaan aktif. Surat Keterangan ini dibuat untuk memenuhi administrasi persyaratan pengajuan pinjaman modal usaha.</p>
                                <p>Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
                            </div>
                            
                            <!-- Tanda Tangan -->
                            <div class="letter-signature">
                                <p>Makmur Sentosa, {{ date('d F Y') }}</p>
                                <p class="sign-role">Kepala Desa Makmur Sentosa</p>
                                <div class="sign-space">
                                    <span class="virtual-stamp">PEMDES VALID</span>
                                </div>
                                <p class="sign-name">Ir. H. Budi Santoso</p>
                            </div>
                        </div>
                        
                        <div class="preview-actions">
                            <button type="button" class="btn btn-secondary-outline" id="btnPrintLetter">
                                <i class="fa-solid fa-print"></i> Cetak Draf
                            </button>
                            <button type="button" class="btn btn-primary" id="btnDownloadPDF">
                                <i class="fa-solid fa-circle-down"></i> Unduh Salinan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Location Section -->
    <section class="contact-section section-padding" id="contact">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Hubungi Kami</span>
                <h2 class="section-title">Hubungi Kantor Desa & Peta</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="contact-grid">
                <!-- Contact Details & Form -->
                <div class="contact-details-panel card-glow">
                    <h3>Kirim Pesan Aspirasi</h3>
                    <p class="contact-intro">Apakah Anda warga desa Makmur Sentosa yang ingin menyampaikan aspirasi, saran, atau memiliki keluhan? Silakan isi formulir di bawah ini dengan lengkap.</p>
                    
                    <!-- Integrated Laravel POST action with CSRF validation -->
                    <form id="contactForm" action="{{ route('aspirasi.submit') }}" method="POST" class="contact-form">
                        @csrf
                        
                        <div class="form-group">
                            <label for="contactName">Nama Anda:</label>
                            <input type="text" id="contactName" name="name" required placeholder="Nama Lengkap" class="form-control-input">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactEmail">Email Aktif:</label>
                            <input type="email" id="contactEmail" name="email" required placeholder="alamat.email@domain.com" class="form-control-input">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactSubject">Subjek / Kategori:</label>
                            <select id="contactSubject" name="subject" class="form-control-select">
                                <option value="aspirasi">Penyampaian Aspirasi Warga</option>
                                <option value="layanan">Tanya Seputar Layanan Publik</option>
                                <option value="pengaduan">Laporan / Pengaduan Umum</option>
                                <option value="wisata">Kerja Sama Pariwisata / UMKM</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contactMessage">Pesan atau Aspirasi:</label>
                            <textarea id="contactMessage" name="message" required rows="4" placeholder="Tuliskan pesan Anda secara jelas di sini..." class="form-control-textarea"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block" id="btnSubmitContact">
                            <span>Kirim Aspirasi</span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Interactive Map / Info Panel -->
                <div class="map-info-panel card-glow">
                    <h3>Lokasi Geografis Desa</h3>
                    
                    <!-- Stylized SVG Vector Map Mockup with Interactive Details -->
                    <div class="vector-map-wrapper">
                        <svg viewBox="0 0 400 250" class="svg-map">
                            <!-- Background Grid -->
                            <defs>
                                <pattern id="mapGrid" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#mapGrid)" rx="12" />
                            
                            <!-- Forest/Mountain Area Vector -->
                            <path d="M 0 50 Q 80 30 160 80 T 320 60 T 400 90 L 400 0 L 0 0 Z" fill="rgba(34, 197, 94, 0.08)" />
                            <!-- River Path Vector -->
                            <path d="M 0 160 C 100 130, 200 220, 400 150" fill="none" stroke="#22d3ee" stroke-width="6" opacity="0.3" stroke-linecap="round"/>
                            <path d="M 0 160 C 100 130, 200 220, 400 150" fill="none" stroke="#0891b2" stroke-width="2" stroke-linecap="round"/>
                            
                            <!-- Rice fields layout -->
                            <rect x="30" y="80" width="80" height="50" rx="6" fill="rgba(234, 179, 8, 0.05)" stroke="rgba(234, 179, 8, 0.15)" stroke-width="1.5" />
                            <line x1="50" y1="80" x2="50" y2="130" stroke="rgba(234, 179, 8, 0.1)" />
                            <line x1="70" y1="80" x2="70" y2="130" stroke="rgba(234, 179, 8, 0.1)" />
                            <line x1="90" y1="80" x2="90" y2="130" stroke="rgba(234, 179, 8, 0.1)" />
                            
                            <rect x="260" y="110" width="100" height="60" rx="6" fill="rgba(34, 197, 94, 0.05)" stroke="rgba(34, 197, 94, 0.15)" stroke-width="1.5" />
                            
                            <!-- Main Road Vector -->
                            <path d="M 180 0 L 180 250" fill="none" stroke="rgba(255, 255, 255, 0.15)" stroke-width="8"/>
                            <path d="M 180 0 L 180 250" fill="none" stroke="#f59e0b" stroke-width="2" stroke-dasharray="6,4"/>
                            
                            <path d="M 0 120 L 400 120" fill="none" stroke="rgba(255, 255, 255, 0.15)" stroke-width="8"/>
                            <path d="M 0 120 L 400 120" fill="none" stroke="#f59e0b" stroke-width="2" stroke-dasharray="6,4"/>
                            
                            <!-- Interactive Map Pins -->
                            <!-- Pin 1: Kantor Desa -->
                            <g class="map-pin active" data-title="Kantor Kepala Desa" data-desc="Jl. Raya Puncak No. 12, Pusat Pelayanan & Koordinasi Administrasi Desa.">
                                <circle cx="180" cy="120" r="14" fill="rgba(16, 185, 129, 0.25)" class="pulse-ring" />
                                <circle cx="180" cy="120" r="6" fill="#10b981" />
                                <i class="fa-solid fa-building-flag pin-icon" style="transform: translate(175px, 110px); font-size: 10px; color: #fff;"></i>
                            </g>
                            
                            <!-- Pin 2: Curug Kembar -->
                            <g class="map-pin" data-title="Curug Kembar Pelangi" data-desc="Ekowisata air terjun alami dengan kolam air jernih dan fasilitas jalur sepeda tracking.">
                                <circle cx="80" cy="50" r="10" fill="rgba(34, 211, 238, 0.25)" class="pulse-ring" />
                                <circle cx="80" cy="50" r="5" fill="#22d3ee" />
                            </g>

                            <!-- Pin 3: Sawah Hijau -->
                            <g class="map-pin" data-title="Lembah Sawah Hijau" data-desc="Sistem irigasi subak persawahan indah dan pertanian terpadu organik desa.">
                                <circle cx="70" cy="105" r="10" fill="rgba(234, 179, 8, 0.25)" class="pulse-ring" />
                                <circle cx="70" cy="105" r="5" fill="#eab308" />
                            </g>

                            <!-- Pin 4: Sanggar Budaya -->
                            <g class="map-pin" data-title="Sanggar Wijayakusuma" data-desc="Pusat latihan seni tari, kerajinan anyaman bambu, dan pelestarian gamelan adat.">
                                <circle cx="310" cy="140" r="10" fill="rgba(236, 72, 153, 0.25)" class="pulse-ring" />
                                <circle cx="310" cy="140" r="5" fill="#ec4899" />
                            </g>
                        </svg>
                        
                        <!-- Map Details Display -->
                        <div class="map-pin-detail-box" id="mapPinDetailBox">
                            <h4 id="pinTitle"><i class="fa-solid fa-location-dot"></i> Kantor Kepala Desa</h4>
                            <p id="pinDesc">Jl. Raya Puncak No. 12, Pusat Pelayanan & Koordinasi Administrasi Desa.</p>
                            <small class="pin-tip">*Ketuk pin berwarna lainnya di peta untuk melihat detail lokasi wisata & kebudayaan.</small>
                        </div>
                    </div>
                    
                    <!-- Contact Cards -->
                    <div class="quick-contact-grid">
                        <div class="contact-info-card">
                            <i class="fa-solid fa-envelope info-icon"></i>
                            <div>
                                <h4>Email Pelayanan</h4>
                                <p>pelayanan@makmursentosa.desa.id</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <i class="fa-solid fa-phone info-icon"></i>
                            <div>
                                <h4>Hotline Pengaduan</h4>
                                <p>+62 812-3456-7890 (WA / Call)</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <i class="fa-solid fa-clock info-icon"></i>
                            <div>
                                <h4>Jam Operasional Kantor</h4>
                                <p>Senin - Jumat | 08:00 - 15:30 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Feedback Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="success-modal-card">
            <div class="success-icon-animation">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3 id="modalTitle">Pesan Berhasil Terkirim!</h3>
            <p id="modalMessage">Terima kasih atas aspirasi Anda. Pemerintah Desa Makmur Sentosa akan meninjau dan merespon pesan Anda sesegera mungkin.</p>
            <button class="btn btn-primary" id="btnCloseModal">Tutup</button>
        </div>
    </div>
@endsection
