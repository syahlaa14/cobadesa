@extends('layouts.app')

@php
    // Extract apparatus database records for the organization chart
    $kades = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'kepala desa') || str_contains(strtolower($item->jabatan), 'kades'));
    $sekdes = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'sekretaris desa') || str_contains(strtolower($item->jabatan), 'sekdes'));
    $kaurPerencanaan = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'perencanaan'));
    $kaurKeuangan = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'keuangan'));
    $kaurTu = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'tu') || str_contains(strtolower($item->jabatan), 'umum'));
    $kadus1 = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'dusun i') && !str_contains(strtolower($item->jabatan), 'dusun ii'));
    $kadus2 = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'dusun ii'));
    $kasiPemerintahan = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'pemerintahan'));
    $kasiKesra = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'kesra') || str_contains(strtolower($item->jabatan), 'kesejahteraan'));
    $kasiPelayanan = $apparatusList->first(fn($item) => str_contains(strtolower($item->jabatan), 'pelayanan'));

    // Extract tourism database records for the interactive map pins
    $curug = $tourismList->firstWhere('title', 'Curug Kembar Pelangi');
    $sawah = $tourismList->firstWhere('title', 'Lembah Sawah Hijau');
    $sanggar = $tourismList->firstWhere('title', 'Sanggar Tari Wijayakusuma') ?? $tourismList->firstWhere('title', 'Sanggar Wijayakusuma');
@endphp

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" id="home" style="background-image: linear-gradient(rgba(17, 34, 25, 0.45), rgba(17, 34, 25, 0.85)), url('{{ asset('images/desa_hero_banner.png') }}');">
        <div class="container hero-container">
            <div class="hero-badge animate-fade-in">
                <i class="fa-solid fa-leaf"></i> Selamat Datang
            </div>
            <h1 class="hero-title animate-fade-in-up">Website Informasi <br><span class="highlight"> Desa Pasir Kulon</span></h1>
            <p class="hero-subtitle animate-fade-in-up">Menghubungkan Masyarakat dengan Informasi dan Layanan Desa yang Terpercaya</p>
            <div class="hero-actions animate-fade-in-up">
                <a href="#about" class="btn btn-primary" id="btnExplore">
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
                <h2 class="section-title">Sekilas Pasir Kulon</h2>
                <div class="title-underline"></div>
            </div>
            
            <div class="about-grid">
                <div class="about-info-card card-glow">
                    <h3>Sejarah & Letak Geografis</h3>
                    <p>Desa Pasir Kulon berdiri sejak tahun 1954 di kaki lembah pegunungan yang subur. Terkenal dengan sistem pengairan subak mandiri dan hasil bumi yang melimpah, desa kami kini bertransformasi menjadi <strong>"Smart Village"</strong> percontohan nasional.</p>
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
                        <p class="vision-text">"TERWUJUDNYA DESA YANG SEJAHTERA MELALUI PENINGKATAN SUMBER DAYA MANUSIA DAN PEMANFAATAN SUMBER DAYA ALAM SECARA OPTIMAL DENGAN DILANDASI NILAI-NILAI AGAMA DAN NORMA SOSIAL"</p>
                    </div>
                    
                    <div class="mission-card">
                        <div class="mission-header">
                            <i class="fa-solid fa-list-check mission-icon"></i>
                            <h3>Misi Kami</h3>
                        </div>
                        <div class="mission-list-wrapper">
                            <ul class="mission-list">
                                <li>
                                    <span class="mission-num">01</span>
                                    <span class="mission-desc">Menciptakan perangkat desa yang profesional, bersih dan partisipasi agar terbangun pemerintahan efektif dan terpercaya sebagai pelayanan masyarakat dan mengupayakan peningkatan kesejahteraan Perangkat Desa.</span>
                                </li>
                                <li>
                                    <span class="mission-num">02</span>
                                    <span class="mission-desc">Meningkatkan partisipasi swadaya pembangunan masyarakat.</span>
                                </li>
                                <li>
                                    <span class="mission-num">03</span>
                                    <span class="mission-desc">Meningkatkan sumber daya manusia melalui pelatihan dan penyuluhan.</span>
                                </li>
                                <li>
                                    <span class="mission-num">04</span>
                                    <span class="mission-desc">Menggali potensi sumber daya alam untuk peningkatan kesejahteraan masyarakat.</span>
                                </li>
                                <li>
                                    <span class="mission-num">05</span>
                                    <span class="mission-desc">Meningkatkan daya kreatifitas usaha ekonomi masyarakat berbasis pertanian, perikanan, perkebunan, industri kecil dan peternakan.</span>
                                </li>
                                <li>
                                    <span class="mission-num">06</span>
                                    <span class="mission-desc">Menumbuhkembangkan pendidikan dan kesehatan berbasis pemberdayaan masyarakat.</span>
                                </li>
                                <li>
                                    <span class="mission-num">07</span>
                                    <span class="mission-desc">Meningkatkan Tertib Administrasi.</span>
                                </li>
                                <li>
                                    <span class="mission-num">08</span>
                                    <span class="mission-desc">Meningkatkan kegiatan sosial masyarakat dan Menumbuhkembangkan Budaya dan Kesenian Lokal.</span>
                                </li>
                                <li>
                                    <span class="mission-num">09</span>
                                    <span class="mission-desc">Menciptakan Kondisi Tertib, Aman, Demokratis Berlandaskan Keselarasan dan berdasarkan Undang-Undang yang Berlaku.</span>
                                </li>
                                <li>
                                    <span class="mission-num">10</span>
                                    <span class="mission-desc">
                                        Membangun sarana prasarana guna percepatan arus ekonomi dan mobilitas masyarakat meliputi:
                                        <ul style="list-style-type: disc; margin-left: 20px; margin-top: 8px; font-size: 13.5px;">
                                            <li>Jalan lingkungan</li>
                                            <li>Jalan desa</li>
                                            <li>Jalan usaha tani</li>
                                        </ul>
                                    </span>
                                </li>
                                <li>
                                    <span class="mission-num">11</span>
                                    <span class="mission-desc">Menjalin Kerja sama antar desa atau pihak ketiga.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Profile Section -->
    <section class="profile-detail-section section-padding" id="profile-detail" style="scroll-margin-top: 80px;">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Profil Informasi</span>
                <h2 class="section-title">Informasi & Profil Pasir Kulon</h2>
                <div class="title-underline"></div>
            </div>

            <div class="profile-tabs-container">
                <!-- Navigation Tabs -->
                <div class="profile-tabs-nav">
                    <button class="profile-tab-btn active" data-target="tab-geografis">
                        <i class="fa-solid fa-map-location-dot"></i> Geografis & Lahan
                    </button>
                    <button class="profile-tab-btn" data-target="tab-demografi">
                        <i class="fa-solid fa-people-group"></i> Demografi Penduduk
                    </button>
                    <button class="profile-tab-btn" data-target="tab-organisasi">
                        <i class="fa-solid fa-sitemap"></i> Struktur Organisasi
                    </button>
                    <button class="profile-tab-btn" data-target="tab-sosial">
                        <i class="fa-solid fa-hands-holding-child"></i> Organisasi Sosial
                    </button>
                    <button class="profile-tab-btn" data-target="tab-ekonomi">
                        <i class="fa-solid fa-seedling"></i> Ekonomi & Pertanian
                    </button>
                </div>

                <!-- Tab Contents -->
                <div class="profile-tab-content">
                    
                    <!-- TAB 1: GEOGRAFIS -->
                    <div class="profile-tab-pane active" id="tab-geografis">
                        <div class="info-grid-2col">
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-earth-asia"></i> Aspek Geografis</h3>
                                <p>Secara Administratif Desa Pasir Kulon termasuk dalam wilayah <strong>Kecamatan Karanglewas, Kabupaten Banyumas</strong>.</p>
                                <p>Aksesibilitas dan waktu tempuh menuju pusat pemerintahan:</p>
                                <ul class="info-list-styled">
                                    <li><i class="fa-solid fa-circle-check"></i> Dapat ditempuh sekitar 20 menit dari Ibu Kota Kabupaten dengan jarak ± 6,3 km.</li>
                                    <li><i class="fa-solid fa-circle-check"></i> Berjarak kurang lebih 3,3 km dari Kantor Kecamatan Karanglewas.</li>
                                </ul>
                                <p>Batas-batas administratif Desa Pasir Kulon:</p>
                                <ul class="info-list-styled">
                                    <li><i class="fa-solid fa-chevron-right"></i> <strong>Sebelah Utara:</strong> Desa Pasir Lor</li>
                                    <li><i class="fa-solid fa-chevron-right"></i> <strong>Sebelah Barat:</strong> Desa Jipang</li>
                                    <li><i class="fa-solid fa-chevron-right"></i> <strong>Sebelah Selatan:</strong> Kelurahan Pasir Kidul</li>
                                    <li><i class="fa-solid fa-chevron-right"></i> <strong>Sebelah Timur:</strong> Desa Pasir Wetan</li>
                                </ul>
                            </div>
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-mountain"></i> Topografi, Hidrologi & Klimatologi</h3>
                                <p>Wilayah Desa Pasir Kulon membujur dari arah utara ke arah selatan. Ketinggian wilayah berada pada kisaran <strong>30 m di atas permukaan laut (dpl)</strong>, tergolong dataran rendah. Pola tanah berupa tanah kering dan sawah dengan pengairan irigasi dan perikanan.</p>
                                <p><strong>Hidrologi & Iklim:</strong> Curah hujan rata-rata mencapai 2.700 mm pertahun dengan suhu rata-rata udara sekitar 32 °C.</p>
                                
                                <h3 style="margin-top: 24px;"><i class="fa-solid fa-chart-pie"></i> Luas & Penggunaan Lahan</h3>
                                <p>Luas total wilayah Desa Pasir Kulon seluruhnya ± <strong>116,8 Ha (1,168 km²)</strong>. Berikut detail pembagian penggunaan lahan:</p>
                                <div class="table-premium-wrapper">
                                    <table class="table-premium">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Penggunaan Lahan</th>
                                                <th>Luas Lahan (Ha)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>Tanah Sawah</td><td>44,40</td></tr>
                                            <tr><td>2</td><td>Tanah Pemukiman</td><td>18,30</td></tr>
                                            <tr><td>3</td><td>Tanah Pekarangan</td><td>24,10</td></tr>
                                            <tr><td>4</td><td>Lain-lain</td><td>0,11</td></tr>
                                            <tr class="total-row"><td></td><td>Jumlah</td><td>86,91</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: DEMOGRAFI -->
                    <div class="profile-tab-pane" id="tab-demografi">
                        <div class="info-grid-2col">
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-users"></i> Jumlah & Komposisi Penduduk</h3>
                                <p>Berdasarkan data sensus penduduk tahun 2021, Desa Pasir Kulon memiliki jumlah penduduk sebanyak <strong>4.320 jiwa</strong>:</p>
                                <ul class="info-list-styled">
                                    <li><i class="fa-solid fa-mars"></i> Penduduk Laki-laki: <strong>2.178 jiwa</strong></li>
                                    <li><i class="fa-solid fa-venus"></i> Penduduk Perempuan: <strong>2.142 jiwa</strong></li>
                                    <li><i class="fa-solid fa-house-user"></i> Total Kepala Keluarga (KK): <strong>1.353 KK</strong></li>
                                </ul>
                                <p>Pekerjaan utama penduduk mencakup sektor tani (petani, buruh tani), buruh bangunan, serta sektor perdagangan UMKM lokal.</p>
                            </div>
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-chart-column"></i> Klasifikasi Penduduk Berdasarkan Kelompok Umur</h3>
                                <div class="table-premium-wrapper">
                                    <table class="table-premium">
                                        <thead>
                                            <tr>
                                                <th>Kelompok Umur (Th)</th>
                                                <th>Laki-laki</th>
                                                <th>Perempuan</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>0 – 4</td><td>158</td><td>150</td><td>308</td></tr>
                                            <tr><td>5 – 9</td><td>188</td><td>190</td><td>378</td></tr>
                                            <tr><td>10 – 14</td><td>179</td><td>157</td><td>336</td></tr>
                                            <tr><td>15 – 19</td><td>178</td><td>166</td><td>344</td></tr>
                                            <tr><td>20 – 24</td><td>154</td><td>171</td><td>325</td></tr>
                                            <tr><td>25 – 29</td><td>142</td><td>126</td><td>268</td></tr>
                                            <tr><td>30 – 39</td><td>344</td><td>348</td><td>692</td></tr>
                                            <tr><td>40 – 49</td><td>340</td><td>312</td><td>652</td></tr>
                                            <tr><td>50 – 59</td><td>241</td><td>250</td><td>491</td></tr>
                                            <tr><td>&gt; 60</td><td>254</td><td>272</td><td>526</td></tr>
                                            <tr class="total-row"><td>Total</td><td>2.178</td><td>2.142</td><td>4.320</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: STRUKTUR ORGANISASI -->
                    <div class="profile-tab-pane" id="tab-organisasi">
                        <div class="info-text-block" style="margin-bottom: 30px;">
                            <h3><i class="fa-solid fa-landmark"></i> Pemerintah Desa Pasir Kulon</h3>
                            <p>Struktur Organisasi Pemerintahan Desa Pasir Kulon Kecamatan Karanglewas Kabupaten Banyumas:</p>
                            
                            <div class="org-chart-container">
                                <div class="org-chart-wrapper">
                                    <div class="org-chart">
                                        <div class="org-row">
                                            <div class="org-card kades-node">
                                                <h4>Kepala Desa</h4>
                                                <div class="name">{{ $kades->nama ?? 'Muhamad Samsi' }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="org-row">
                                            <div class="org-card sekdes-node">
                                                <h4>Sekretaris Desa</h4>
                                                <div class="name">{{ $sekdes->nama ?? 'Edi Mulyono' }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="org-row">
                                            <div class="org-card">
                                                <h4>Kaur Perencanaan</h4>
                                                <div class="name">{{ $kaurPerencanaan->nama ?? 'Yuliana Puspa Dewi' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kaur Keuangan</h4>
                                                <div class="name">{{ $kaurKeuangan->nama ?? 'Siti Aminah' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kaur TU & Umum</h4>
                                                <div class="name">{{ $kaurTu->nama ?? 'Suprapti' }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="org-row">
                                            <div class="org-card">
                                                <h4>Kadus I</h4>
                                                <div class="name">{{ $kadus1->nama ?? 'Sachirun' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kadus II</h4>
                                                <div class="name">{{ $kadus2->nama ?? 'Mei Nur Khasanah' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kasi Pemerintahan</h4>
                                                <div class="name">{{ $kasiPemerintahan->nama ?? 'Mualif' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kasi Kesra</h4>
                                                <div class="name">{{ $kasiKesra->nama ?? 'Imam Buchori' }}</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Kasi Pelayanan</h4>
                                                <div class="name">{{ $kasiPelayanan->nama ?? 'Wawan Riyanto' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-text-block">
                            <h3><i class="fa-solid fa-users-rectangle"></i> Badan Permusyawaratan Desa (BPD)</h3>
                            <p>Struktur Organisasi BPD Desa Pasir Kulon Kecamatan Karanglewas:</p>
                            
                            <div class="org-chart-container" style="background: #f8fafc;">
                                <div class="org-chart-wrapper">
                                    <div class="org-chart">
                                        <div class="org-row">
                                            <div class="org-card bpd-node">
                                                <h4>Ketua BPD</h4>
                                                <div class="name">Syamsul, S.Pd</div>
                                            </div>
                                        </div>
                                        
                                        <div class="org-row">
                                            <div class="org-card">
                                                <h4>Wakil Ketua</h4>
                                                <div class="name">Drs. Sudiyono Ahmad</div>
                                            </div>
                                            <div class="org-card">
                                                <h4>Sekretaris</h4>
                                                <div class="name">Syarif Hidayat, S.Ag</div>
                                            </div>
                                        </div>
                                        
                                        <div class="org-row" style="flex-wrap: wrap; max-width: 700px; margin: 0 auto; gap: 12px;">
                                            <div class="org-card"><h4>Anggota</h4><div class="name">Kholikun</div></div>
                                            <div class="org-card"><h4>Anggota</h4><div class="name">Kodir</div></div>
                                            <div class="org-card"><h4>Anggota</h4><div class="name">M. Taufiq</div></div>
                                            <div class="org-card"><h4>Anggota</h4><div class="name">Lilik Prasetya, S.Pd</div></div>
                                            <div class="org-card"><h4>Anggota</h4><div class="name">Suryanti, S.Pd</div></div>
                                            <div class="org-card"><h4>Anggota</h4><div class="name">Akhmad Amsori</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: SOSIAL KEAGAMAAN -->
                    <div class="profile-tab-pane" id="tab-sosial">
                        <div class="info-text-block">
                            <h3><i class="fa-solid fa-mosque"></i> Organisasi Sosial Keagamaan</h3>
                            <p>Daftar organisasi keagamaan dan kemasyarakatan di Desa Pasir Kulon beserta pengurus dan wilayah tugas:</p>
                            <div class="table-premium-wrapper">
                                <table class="table-premium">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Organisasi</th>
                                            <th>Nama Pengurus</th>
                                            <th>Jabatan</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>1</td><td>NU</td><td>Rohman</td><td>Ketua</td><td>Pasir Kulon RT 02 RW 04</td></tr>
                                        <tr><td>2</td><td>Fatayat NU</td><td>Zaenatul Fitri</td><td>Ketua</td><td>Pasir Kulon RT 02 RW 04</td></tr>
                                        <tr><td>3</td><td>Muslimat NU</td><td>Muhlishoh</td><td>Ketua</td><td>Pasir Kulon RT 02 RW 02</td></tr>
                                        <tr><td>4</td><td>GP Ansor</td><td>Ahmad Ilham Hamdani</td><td>Ketua</td><td>Pasir Kulon RT 02 RW 05</td></tr>
                                        <tr><td>5</td><td>Muhammadiyah</td><td>Agus Riyanto</td><td>Ketua</td><td>Pasir Kulon RT 01 RW 03</td></tr>
                                        <tr><td>6</td><td>Aisyiyah</td><td>Yuliana Puspa Dewi</td><td>Ketua</td><td>Pasir Kulon RT 01 RW 03</td></tr>
                                        <tr><td>7</td><td>Pemuda Muhammadiyah</td><td>Farel Anggun Nandana</td><td>Ketua</td><td>Pasir Kulon RT 01 RW 03</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: EKONOMI & PERTANIAN -->
                    <div class="profile-tab-pane" id="tab-ekonomi">
                        <div class="info-grid-2col">
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-wheat-awn"></i> Hasil Pertanian</h3>
                                <p>Dilihat dari komoditas yang diusahakan, sistem usaha tani yang ada di desa Pasir Kulon dibedakan menjadi dua bagian, yaitu komoditas pertanian seperti Padi luas tanam <strong>37.096 ha</strong> menghasilkan <strong>165.48 ton</strong> per tahun. Komoditas perkebunan yang dimiliki desa Pasir Kulon meliputi:</p>
                                <ul class="info-list-styled">
                                    <li><i class="fa-solid fa-seedling"></i> <strong>a. Padi</strong></li>
                                    <li><i class="fa-solid fa-fish"></i> <strong>b. Perikanan</strong></li>
                                    <li><i class="fa-solid fa-apple-whole"></i> <strong>c. Rambutan</strong></li>
                                    <li><i class="fa-solid fa-lemon"></i> <strong>d. Duku</strong></li>
                                    <li><i class="fa-solid fa-chevron-right"></i> <strong>e. Pisang</strong></li>
                                </ul>
                            </div>
                            <div class="info-text-block">
                                <h3><i class="fa-solid fa-kitchen-set"></i> Usaha Pengrajin Makanan</h3>
                                <p>Tersedianya bahan baku dari hasil pertanian dan perkebunan menumbuh kembangkan produksi makanan ringan meliputi:</p>
                                <ul class="info-list-styled">
                                    <li><i class="fa-solid fa-cookie-bite"></i> <strong>a. Kripik Tempe Singkong:</strong> singkong bahan baku campuran kedelai dan singkong</li>
                                    <li><i class="fa-solid fa-bowl-food"></i> <strong>b. Peyek</strong></li>
                                    <li><i class="fa-solid fa-egg"></i> <strong>c. Telur Asin</strong></li>
                                    <li><i class="fa-solid fa-bread-slice"></i> <strong>d. Roti</strong></li>
                                    <li><i class="fa-solid fa-gem"></i> <strong>e. Pengrajin Emas</strong></li>
                                </ul>
                            </div>
                        </div>
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
                <div class="stat-card" data-target="4320">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix">+</span>
                    </div>
                    <p class="stat-label">Jumlah Penduduk (Jiwa)</p>
                </div>
                
                <!-- Stat Item 2 -->
                <div class="stat-card" data-target="116">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix">,8 Ha</span>
                    </div>
                    <p class="stat-label">Luas Wilayah Desa</p>
                </div>
                
                <!-- Stat Item 3 -->
                <div class="stat-card" data-target="165">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix">,48 Ton/Thn</span>
                    </div>
                    <p class="stat-label">Hasil Panen Padi / Tahun</p>
                </div>
                
                <!-- Stat Item 4 -->
                <div class="stat-card" data-target="1353">
                    <div class="stat-icon-wrapper">
                        <i class="fa-solid fa-house-user"></i>
                    </div>
                    <div class="stat-number-wrapper">
                        <span class="stat-number">0</span><span class="stat-suffix"> KK</span>
                    </div>
                    <p class="stat-label">Kepala Keluarga (KK)</p>
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
                            @if ($app['foto'] && \Illuminate\Support\Str::startsWith($app['foto'], 'uploads/'))
                                <img src="{{ asset($app['foto']) }}" alt="{{ $app['nama'] }}" class="apparatus-img">
                            @else
                                <div class="avatar-placeholder"><i class="fa-solid {{ $app['foto'] }}"></i></div>
                            @endif
                            <div class="apparatus-socials">
                                <a href="{{ $app['facebook'] }}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="{{ $app['instagram'] }}" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a href="mailto:{{ $app['email'] }}" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="apparatus-info">
                            <h3>{{ $app['nama'] }}</h3>
                            <span class="apparatus-role">{{ $app['jabatan'] }}</span>
                            <p class="apparatus-desc">{{ $app['keterangan_jabatan'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="news-events-section section-padding" id="news-events" style="background: var(--light); scroll-margin-top: 80px;">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tagline">Kabar & Agenda</span>
                <h2 class="section-title">Berita & Kegiatan Terbaru</h2>
                <div class="title-underline"></div>
            </div>
            <div class="news-events-grid">
                <!-- Left: News Section -->
                <div class="news-column">
                    <h3 class="column-title" style="font-size: 1.5rem; margin-bottom: 24px; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-newspaper" style="color: var(--primary-light);"></i> Kabar Pasir Kulon
                    </h3>
                    
                    @if($newsList->isEmpty())
                        <div class="card-glow" style="background: var(--white); padding: 30px; border-radius: var(--border-radius-md); text-align: center; color: var(--gray-500);">
                            <i class="fa-solid fa-bullhorn" style="font-size: 2rem; margin-bottom: 12px; display: block; color: var(--gray-400);"></i>
                            Belum ada berita atau pengumuman terbaru saat ini.
                        </div>
                    @else
                        @php
                            $featuredNews = $newsList->first();
                            $olderNews = $newsList->slice(1);
                        @endphp
                        
                        <!-- Featured News Card -->
                        <div class="news-card card-glow" style="background: var(--white); padding: 28px; border-radius: var(--border-radius-md); border: 1px solid var(--gray-100); display: flex; gap: 20px; position: relative; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid var(--primary-light); margin-bottom: 24px; height: 320px; box-sizing: border-box; align-items: flex-start;">
                            <div class="news-icon-decor" style="width: 64px; height: 64px; border-radius: var(--border-radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; background: rgba(16, 185, 129, 0.08);">
                                @if($featuredNews->gambar && \Illuminate\Support\Str::startsWith($featuredNews->gambar, 'uploads/'))
                                    <img src="{{ asset($featuredNews->gambar) }}" alt="{{ $featuredNews->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="font-size: 2.2rem; color: var(--primary-glow); display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                        <i class="fa-solid {{ $featuredNews->gambar ?? 'fa-newspaper' }}" style="color: var(--primary-light);"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="news-details" style="flex: 1; display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                                <div>
                                    <div class="news-meta" style="display: flex; gap: 12px; align-items: center; margin-bottom: 10px; font-size: 0.8rem; color: var(--gray-500);">
                                        <span class="badge" style="background: var(--primary-glow); color: var(--primary-light); padding: 4px 10px; border-radius: 20px; font-weight: 600;">{{ $featuredNews->kategori->nama ?? 'Umum' }}</span>
                                        <span><i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ \Carbon\Carbon::parse($featuredNews->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}</span>
                                        <span style="font-size: 0.72rem; color: var(--primary-light); font-weight: bold; background: rgba(16, 185, 129, 0.1); padding: 2px 8px; border-radius: 4px;">Terbaru</span>
                                    </div>
                                    <h4 style="font-size: 1.25rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; line-height: 1.4;">{{ $featuredNews->judul }}</h4>
                                    <p style="font-size: 0.9rem; color: var(--gray-600); line-height: 1.6; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ Str::limit(strip_tags($featuredNews->konten), 160) }}
                                    </p>
                                </div>
                                <button class="btn-read-more" 
                                    data-judul="{{ $featuredNews->judul }}" 
                                    data-kategori="{{ $featuredNews->kategori->nama ?? 'Umum' }}" 
                                    data-tanggal="{{ \Carbon\Carbon::parse($featuredNews->created_at)->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }}" 
                                    data-konten="{{ $featuredNews->konten }}" 
                                    data-gambar="{{ ($featuredNews->gambar && \Illuminate\Support\Str::startsWith($featuredNews->gambar, 'uploads/')) ? asset($featuredNews->gambar) : '' }}"
                                    style="background: none; border: none; color: var(--primary-light); font-weight: 700; font-size: 0.9rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; padding: 0; transition: color 0.2s; align-self: flex-start;"
                                >
                                    Baca Berita Utama <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Older News Slider -->
                        @if($olderNews->isNotEmpty())
                            <div class="older-news-slider-wrapper">
                                <div class="slider-header">
                                    <h4><i class="fa-solid fa-clock-rotate-left" style="color: var(--gray-500); margin-right: 6px;"></i> Berita Lainnya</h4>
                                    <div class="slider-nav">
                                        <button type="button" class="btn-slide-prev" id="newsPrev" aria-label="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                                        <button type="button" class="btn-slide-next" id="newsNext" aria-label="Selanjutnya"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </div>
                                <div class="older-news-slider" id="newsSlider">
                                    @foreach($olderNews as $newsItem)
                                        <div class="news-slide-card">
                                            <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px; font-size: 0.75rem; color: var(--gray-500); flex-wrap: wrap;">
                                                <span class="badge" style="background: var(--primary-glow); color: var(--primary-light); padding: 2px 8px; border-radius: 20px; font-weight: 600;">{{ $newsItem->kategori->nama ?? 'Umum' }}</span>
                                                <span>{{ \Carbon\Carbon::parse($newsItem->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}</span>
                                            </div>
                                            <h5 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.8em;">{{ $newsItem->judul }}</h5>
                                            <p style="font-size: 0.8rem; color: var(--gray-600); line-height: 1.5; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 4.5em;">
                                                {{ Str::limit(strip_tags($newsItem->konten), 90) }}
                                            </p>
                                            <button class="btn-read-more" 
                                                data-judul="{{ $newsItem->judul }}" 
                                                data-kategori="{{ $newsItem->kategori->nama ?? 'Umum' }}" 
                                                data-tanggal="{{ \Carbon\Carbon::parse($newsItem->created_at)->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }}" 
                                                data-konten="{{ $newsItem->konten }}" 
                                                data-gambar="{{ ($newsItem->gambar && \Illuminate\Support\Str::startsWith($newsItem->gambar, 'uploads/')) ? asset($newsItem->gambar) : '' }}"
                                                style="background: none; border: none; color: var(--primary-light); font-weight: 700; font-size: 0.8rem; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; padding: 0; transition: color 0.2s;"
                                            >
                                                Baca Berita <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Right: Events Section -->
                <div class="events-column">
                    <h3 class="column-title" style="font-size: 1.5rem; margin-bottom: 24px; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-calendar-days" style="color: var(--accent);"></i> Agenda Kegiatan Desa
                    </h3>

                    @if($eventsList->isEmpty())
                        <div class="card-glow" style="background: var(--white); padding: 30px; border-radius: var(--border-radius-md); text-align: center; color: var(--gray-500);">
                            <i class="fa-solid fa-calendar-xmark" style="font-size: 2rem; margin-bottom: 12px; display: block; color: var(--gray-400);"></i>
                            Belum ada jadwal kegiatan desa saat ini.
                        </div>
                    @else
                        @php
                            $featuredEvent = $eventsList->first();
                            $olderEvents = $eventsList->slice(1);
                        @endphp
                        
                        <!-- Featured Event Card -->
                        <div class="event-card card-glow" style="background: var(--white); padding: 28px; border-radius: var(--border-radius-md); border: 1px solid var(--gray-100); display: flex; gap: 20px; position: relative; overflow: hidden; transition: transform 0.3s ease; border-left: 4px solid var(--accent); margin-bottom: 24px; height: 320px; box-sizing: border-box; align-items: flex-start;">
                            <div class="event-date-badge" style="width: 64px; height: 64px; background: linear-gradient(135deg, var(--dark) 0%, var(--dark-surface) 100%); color: var(--white); border-radius: var(--border-radius-sm); display: flex; flex-direction: column; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: var(--shadow-sm); box-sizing: border-box; padding: 4px;">
                                <span class="day" style="font-size: 1.3rem; font-weight: 800; line-height: 1;">{{ \Carbon\Carbon::parse($featuredEvent->tanggal_mulai)->format('d') }}</span>
                                <span class="month" style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">{{ \Carbon\Carbon::parse($featuredEvent->tanggal_mulai)->format('M') }}</span>
                            </div>
                            <div class="event-info" style="flex: 1; display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                                <div>
                                    <div class="event-meta" style="display: flex; gap: 12px; align-items: center; margin-bottom: 10px; font-size: 0.8rem; color: var(--gray-500); flex-wrap: wrap;">
                                        <span class="badge" style="background: rgba(234, 179, 8, 0.1); color: var(--accent); padding: 4px 10px; border-radius: 20px; font-weight: 600;">Agenda</span>
                                        <span><i class="fa-solid fa-location-dot" style="margin-right: 4px; color: var(--primary-light);"></i> {{ Str::limit($featuredEvent->lokasi, 25) }}</span>
                                        <span style="font-size: 0.72rem; color: var(--accent); font-weight: bold; background: rgba(234, 179, 8, 0.15); padding: 2px 8px; border-radius: 4px;">Terdekat</span>
                                    </div>
                                    <h4 style="font-size: 1.25rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; line-height: 1.4;">{{ $featuredEvent->judul }}</h4>
                                    <p style="font-size: 0.9rem; color: var(--gray-600); line-height: 1.6; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $featuredEvent->deskripsi }}
                                    </p>
                                </div>
                                <button class="btn-read-more" 
                                    data-judul="{{ $featuredEvent->judul }}" 
                                    data-kategori="Agenda Kegiatan" 
                                    data-tanggal="{{ \Carbon\Carbon::parse($featuredEvent->tanggal_mulai)->format('d F Y') }} | Lokasi: {{ $featuredEvent->lokasi }}" 
                                    data-konten="{{ $featuredEvent->deskripsi }}" 
                                    data-gambar=""
                                    style="background: none; border: none; color: var(--accent); font-weight: 700; font-size: 0.9rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; padding: 0; transition: color 0.2s; align-self: flex-start;"
                                >
                                    Lihat Detail Agenda <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Older Events Slider -->
                        @if($olderEvents->isNotEmpty())
                            <div class="older-events-slider-wrapper">
                                <div class="slider-header">
                                    <h4><i class="fa-solid fa-clock-rotate-left" style="color: var(--gray-500); margin-right: 6px;"></i> Agenda Lainnya</h4>
                                    <div class="slider-nav">
                                        <button type="button" class="btn-slide-prev" id="eventPrev" aria-label="Sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                                        <button type="button" class="btn-slide-next" id="eventNext" aria-label="Selanjutnya"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </div>
                                <div class="older-events-slider" id="eventSlider">
                                    @foreach($olderEvents as $eventItem)
                                        <div class="event-slide-card">
                                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                                <div class="event-slide-date" style="font-size: 0.72rem; font-weight: 700; color: var(--gray-500); background: var(--gray-100); padding: 2px 6px; border-radius: 4px;">
                                                    {{ \Carbon\Carbon::parse($eventItem->tanggal_mulai)->format('d M Y') }}
                                                </div>
                                                @if($eventItem->status === 'rencana')
                                                    <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: #2563eb; font-size: 0.65rem; padding: 1px 6px; border-radius: 10px; font-weight: 700; text-transform: uppercase;">Rencana</span>
                                                @elseif($eventItem->status === 'berjalan')
                                                    <span class="badge" style="background: rgba(234, 179, 8, 0.1); color: #ca8a04; font-size: 0.65rem; padding: 1px 6px; border-radius: 10px; font-weight: 700; text-transform: uppercase;">Berjalan</span>
                                                @else
                                                    <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #059669; font-size: 0.65rem; padding: 1px 6px; border-radius: 10px; font-weight: 700; text-transform: uppercase;">Selesai</span>
                                                @endif
                                            </div>
                                            <h5 style="font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.8em;">{{ $eventItem->judul }}</h5>
                                            <p style="font-size: 0.8rem; color: var(--gray-600); line-height: 1.5; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; height: 4.5em;">
                                                {{ Str::limit($eventItem->deskripsi, 90) }}
                                            </p>
                                            <button class="btn-read-more" 
                                                data-judul="{{ $eventItem->judul }}" 
                                                data-kategori="Agenda Kegiatan" 
                                                data-tanggal="{{ \Carbon\Carbon::parse($eventItem->tanggal_mulai)->format('d F Y') }} | Lokasi: {{ $eventItem->lokasi }}" 
                                                data-konten="{{ $eventItem->deskripsi }}" 
                                                data-gambar=""
                                                style="background: none; border: none; color: var(--accent); font-weight: 700; font-size: 0.8rem; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; padding: 0; transition: color 0.2s;"
                                            >
                                                Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size: 0.7rem;"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- News Details Modal (Popup Dialog) -->
    <div id="newsModal" class="custom-modal-overlay" style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 20px; opacity: 0; transition: opacity 0.3s ease;">
        <div class="custom-modal-card card-glow" style="background: var(--white); width: 100%; max-width: 650px; border-radius: var(--border-radius-md); overflow: hidden; transform: scale(0.9); transition: transform 0.3s ease; display: flex; flex-direction: column; max-height: 90vh;">
            <div class="modal-card-header" style="padding: 24px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; background: linear-gradient(135deg, var(--dark) 0%, var(--dark-surface) 100%); color: var(--white);">
                <div style="flex: 1;">
                    <span id="modalKategori" class="badge" style="background: var(--primary-light); color: var(--white); padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; margin-bottom: 8px; display: inline-block;"></span>
                    <h3 id="modalTitle" style="font-size: 1.4rem; font-weight: 800; line-height: 1.3; margin: 0; color: var(--white);"></h3>
                    <div id="modalTanggal" style="font-size: 0.8rem; opacity: 0.8; margin-top: 8px;"><i class="fa-regular fa-calendar"></i> </div>
                </div>
                <button id="modalCloseBtn" style="background: rgba(255,255,255,0.1); border: none; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; color: var(--white); cursor: pointer; font-size: 1.1rem; transition: background 0.2s; flex-shrink: 0;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="modalBody" style="padding: 24px; overflow-y: auto; font-size: 1rem; color: var(--gray-700); line-height: 1.7; flex: 1;">
                <div id="modalImageContainer" style="display: none; margin-bottom: 20px; border-radius: var(--border-radius-sm); overflow: hidden; max-height: 300px; border: 1px solid var(--gray-100);">
                    <img id="modalImage" src="" alt="Foto Berita" style="width: 100%; height: auto; display: block; object-fit: cover;">
                </div>
                <div id="modalTextContent"></div>
            </div>
            <div style="padding: 16px 24px; border-top: 1px solid var(--gray-100); background: var(--gray-50); display: flex; justify-content: flex-end;">
                <button id="modalCloseFooter" class="btn btn-secondary" style="padding: 8px 20px; font-weight: 600; font-size: 0.9rem;">Tutup</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('newsModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalKategori = document.getElementById('modalKategori');
        const modalTanggal = document.getElementById('modalTanggal');
        const modalBody = document.getElementById('modalBody');
        const closeBtn = document.getElementById('modalCloseBtn');
        const closeFooter = document.getElementById('modalCloseFooter');

        function openModal(btn) {
            const title = btn.getAttribute('data-judul');
            const category = btn.getAttribute('data-kategori');
            const date = btn.getAttribute('data-tanggal');
            const content = btn.getAttribute('data-konten');
            const gambar = btn.getAttribute('data-gambar');

            modalTitle.textContent = title;
            modalKategori.textContent = category;
            modalTanggal.innerHTML = `<i class="fa-regular fa-calendar"></i> ${date}`;
            
            const textContentEl = document.getElementById('modalTextContent');
            if (textContentEl) {
                textContentEl.innerHTML = content.replace(/\n/g, '<br>');
            } else {
                modalBody.innerHTML = content.replace(/\n/g, '<br>');
            }

            const imgContainer = document.getElementById('modalImageContainer');
            const imgEl = document.getElementById('modalImage');
            if (imgContainer && imgEl) {
                if (gambar) {
                    imgEl.src = gambar;
                    imgContainer.style.display = 'block';
                } else {
                    imgEl.src = '';
                    imgContainer.style.display = 'none';
                }
            }

            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.querySelector('.custom-modal-card').style.transform = 'scale(1)';
            }, 10);
        }

        function closeModal() {
            modal.style.opacity = '0';
            modal.querySelector('.custom-modal-card').style.transform = 'scale(0.9)';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        document.querySelectorAll('.btn-read-more').forEach(btn => {
            btn.addEventListener('click', function() {
                openModal(this);
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (closeFooter) closeFooter.addEventListener('click', closeModal);

        // Close when clicking outside of card
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
    </script>

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
                    <p>Selamat datang di sistem <strong>E-Surat Mandiri</strong> Desa Pasir Kulon. Anda dapat membuat rancangan draf surat keterangan umum secara instan di sini untuk mempercepat pengurusan berkas fisik di kantor desa.</p>
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
                                    <h3>KANTOR KEPALA DESA PASIR KULON</h3>
                                    <p class="letter-sub">Jl. Raya Puncak No. 12, Kode Pos 40391 | Email: desa@pasirkulon.sch.id</p>
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
                                <p>Yang bertanda tangan di bawah ini, Kepala Desa Pasir Kulon, Kecamatan Harapan Indah, Kabupaten Jaya Raya, dengan ini menerangkan bahwa:</p>
                                
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
                                
                                <p id="prevClosing">Benar bahwa nama di atas memiliki usaha yang terdaftar di Desa Pasir Kulon dan dalam keadaan aktif. Surat Keterangan ini dibuat untuk memenuhi administrasi persyaratan pengajuan pinjaman modal usaha.</p>
                                <p>Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
                            </div>
                            
                            <!-- Tanda Tangan -->
                            <div class="letter-signature">
                                <p>Pasir Kulon, {{ date('d F Y') }}</p>
                                <p class="sign-role">Kepala Desa Pasir Kulon</p>
                                <div class="sign-space">
                                    <span class="virtual-stamp">PEMDES VALID</span>
                                </div>
                                <p class="sign-name">Ir. H. Budi Santoso</p>
                            </div>
                        </div>
                        
                        <div class="preview-actions">
                            <button type="button" class="btn btn-secondary-outline" id="btnPrintLetter" style="width: 100%;">
                                <i class="fa-solid fa-print"></i> Cetak Draf
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
                    <p class="contact-intro">Apakah Anda warga desa Pasir Kulon yang ingin menyampaikan aspirasi, saran, atau memiliki keluhan? Silakan isi formulir di bawah ini dengan lengkap.</p>
                    
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
                                <option value="wisata">Kerja Sama UMKM</option>
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
                            <g class="map-pin" data-title="{{ $curug?->title ?? 'Curug Kembar Pelangi' }}" data-desc="{{ $curug?->desc ?? 'Ekowisata air terjun alami dengan kolam air jernih dan fasilitas jalur sepeda tracking.' }}">
                                <circle cx="80" cy="50" r="10" fill="rgba(34, 211, 238, 0.25)" class="pulse-ring" />
                                <circle cx="80" cy="50" r="5" fill="#22d3ee" />
                            </g>

                            <!-- Pin 3: Sawah Hijau -->
                            <g class="map-pin" data-title="{{ $sawah?->title ?? 'Lembah Sawah Hijau' }}" data-desc="{{ $sawah?->desc ?? 'Sistem irigasi subak persawahan indah dan pertanian terpadu organik desa.' }}">
                                <circle cx="70" cy="105" r="10" fill="rgba(234, 179, 8, 0.25)" class="pulse-ring" />
                                <circle cx="70" cy="105" r="5" fill="#eab308" />
                            </g>

                            <!-- Pin 4: Sanggar Budaya -->
                            <g class="map-pin" data-title="{{ $sanggar?->title ?? 'Sanggar Wijayakusuma' }}" data-desc="{{ $sanggar?->desc ?? 'Pusat latihan seni tari, kerajinan anyaman bambu, dan pelestarian gamelan adat.' }}">
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
                                <p>pelayanan@pasirkulon.desa.id</p>
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
            <p id="modalMessage">Terima kasih atas aspirasi Anda. Pemerintah Desa Pasir Kulon akan meninjau dan merespon pesan Anda sesegera mungkin.</p>
            <button class="btn btn-primary" id="btnCloseModal">Tutup</button>
        </div>
    </div>

@endsection
