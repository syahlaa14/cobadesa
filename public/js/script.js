/* ==========================================================================
   SCRIPT.JS - WEBSITE PROFIL DESA MAKMUR SENTOSA (PREMIUM INTERACTIVE)
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    
    /* ==========================================
       1. STICKY HEADER & MOBILE MENU TOGGLE
       ========================================== */
    const mainHeader = document.getElementById('mainHeader');
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Header scroll event
    const handleScroll = () => {
        if (window.scrollY > 50) {
            mainHeader.classList.add('scrolled');
        } else {
            mainHeader.classList.remove('scrolled');
        }
    };
    
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Mobile menu toggle
    mobileToggle.addEventListener('click', () => {
        const expanded = mobileToggle.getAttribute('aria-expanded') === 'true' || false;
        mobileToggle.setAttribute('aria-expanded', !expanded);
        mobileToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Close mobile menu when nav link is clicked
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileToggle.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });

    // Sync active nav links on scroll using Intersection Observer
    const sections = document.querySelectorAll('section');
    const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -60% 0px', // Adjust to trigger when section occupies central screen
        threshold: 0
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${id}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, observerOptions);

    sections.forEach(section => {
        sectionObserver.observe(section);
    });


    /* ==========================================
       2. ANIMATED STATISTICS COUNTER
       ========================================== */
    const statsSection = document.getElementById('stats');
    const statCards = document.querySelectorAll('.stat-card');
    let countersStarted = false;

    const runCounters = () => {
        statCards.forEach(card => {
            const numEl = card.querySelector('.stat-number');
            const target = parseInt(card.getAttribute('data-target'), 10);
            const duration = 2000; // 2 seconds animation
            const stepTime = Math.max(Math.floor(duration / target), 15);
            let current = 0;
            
            // Calculate increment based on target size
            const increment = target > 500 ? Math.ceil(target / 100) : 1;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    numEl.textContent = target.toLocaleString('id-ID');
                    clearInterval(timer);
                } else {
                    numEl.textContent = current.toLocaleString('id-ID');
                }
            }, stepTime);
        });
    };

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !countersStarted) {
                countersStarted = true;
                runCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    if (statsSection) {
        statsObserver.observe(statsSection);
    }


    /* ==========================================
       3. TOURISM & CULTURE GALLERY FILTER
       ========================================== */
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all buttons
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                // Add soft scale animation
                item.style.transform = 'scale(0.95)';
                item.style.opacity = '0';

                setTimeout(() => {
                    if (filterValue === 'all' || filterValue === category) {
                        item.classList.remove('hidden');
                        setTimeout(() => {
                            item.style.transform = 'scale(1)';
                            item.style.opacity = '1';
                        }, 50);
                    } else {
                        item.classList.add('hidden');
                    }
                }, 300);
            });
        });
    });


    /* ==========================================
       4. INTERACTIVE ONLINE DOCUMENT GENERATOR
       ========================================== */
    const serviceSelector = document.getElementById('serviceSelector');
    const dynamicFieldWrapper = document.getElementById('dynamicFieldWrapper');
    const dynamicLabel = document.getElementById('dynamicLabel');
    const docDetail = document.getElementById('docDetail');
    const docGeneratorForm = document.getElementById('docGeneratorForm');

    // Letter Preview Elements
    const prevTitle = document.getElementById('prevTitle');
    const prevNumber = document.getElementById('prevNumber');
    const prevName = document.getElementById('prevName');
    const prevNik = document.getElementById('prevNik');
    const prevAddress = document.getElementById('prevAddress');
    const prevDynamicLabel = document.getElementById('prevDynamicLabel');
    const prevDynamicValue = document.getElementById('prevDynamicValue');
    const prevClosing = document.getElementById('prevClosing');
    const virtualLetter = document.getElementById('virtualLetter');

    // Document types definition
    const docTypes = {
        sku: {
            title: "SURAT KETERANGAN USAHA",
            numberPrefix: "503",
            label: "Detail Usaha & Lokasi:",
            placeholder: "Contoh: Toko Kelontong 'Barokah', RT 03 Dusun Mawar",
            previewLabel: "Jenis Usaha",
            closing: "Benar bahwa nama di atas memiliki usaha yang terdaftar di Desa Makmur Sentosa dan dalam keadaan aktif. Surat Keterangan ini dibuat untuk memenuhi administrasi persyaratan pengajuan pinjaman modal usaha."
        },
        sktm: {
            title: "SURAT KETERANGAN TIDAK MAMPU",
            numberPrefix: "401",
            label: "Keperluan Pengajuan Surat:",
            placeholder: "Contoh: Pengajuan Beasiswa Pendidikan Sekolah Anak",
            previewLabel: "Tujuan Pengajuan",
            closing: "Benar bahwa nama di atas adalah warga asli Desa Makmur Sentosa yang tergolong dalam keluarga ekonomi rentan/kurang mampu. Surat Keterangan ini dibuat sebagai lampiran persyaratan pengajuan bantuan sosial."
        },
        sp: {
            title: "SURAT PENGANTAR PENGURUSAN",
            numberPrefix: "140",
            label: "Tujuan Pengurusan Dokumen:",
            placeholder: "Contoh: Pengurusan KTP Baru / Perekaman Data Kependudukan",
            previewLabel: "Tujuan Surat",
            closing: "Benar bahwa nama di atas adalah penduduk yang berdomisili sah di Desa Makmur Sentosa. Surat Keterangan Pengantar ini dibuat untuk memperlancar administrasi pengurusan dokumen kependudukan tingkat Kecamatan."
        }
    };

    // Change form fields dynamically based on letter selection
    serviceSelector.addEventListener('change', (e) => {
        const type = e.target.value;
        const config = docTypes[type];

        if (config) {
            dynamicLabel.innerHTML = `<i class="fa-solid fa-circle-info form-icon"></i> ${config.label}`;
            docDetail.placeholder = config.placeholder;
            docDetail.value = '';

            // Update letter title, number code, labels
            prevTitle.textContent = config.title;
            prevNumber.textContent = `${config.numberPrefix} / ${Math.floor(Math.random() * 200) + 100}`;
            prevDynamicLabel.textContent = config.previewLabel;
            prevDynamicValue.textContent = "—";
            prevClosing.textContent = config.closing;
        }
    });

    // Real-time text preview bindings
    const inputs = [
        { id: 'docName', el: prevName, default: 'Nama Lengkap Warga' },
        { id: 'docNik', el: prevNik, default: '3204XXXXXXXXXXXXXXXX' },
        { id: 'docAddress', el: prevAddress, default: 'RT XX / RW XX, Dusun XXXXXX' },
        { id: 'docDetail', el: prevDynamicValue, default: '—' }
    ];

    inputs.forEach(item => {
        const inputEl = document.getElementById(item.id);
        if (inputEl) {
            inputEl.addEventListener('input', (e) => {
                let val = e.target.value.trim();
                
                // Add uppercase spacing for NIK length
                if (item.id === 'docNik') {
                    // Limit non-digits
                    val = val.replace(/\D/g, '');
                    e.target.value = val;
                }

                item.el.textContent = val !== '' ? val : item.default;
            });
        }
    });

    // Submit Document Generation (Simulation)
    docGeneratorForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const btn = document.getElementById('btnGenerate');
        const stamp = virtualLetter.querySelector('.virtual-stamp');
        
        // Show loading simulation on button
        btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Memvalidasi Dokumen...`;
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = `<i class="fa-solid fa-circle-check"></i> Surat Berhasil Dibuat`;
            btn.style.background = 'linear-gradient(135deg, #059669, #10b981)';
            
            // Highlight stamp and add valid stamp class
            stamp.style.borderColor = '#dc2626';
            stamp.style.color = '#dc2626';
            stamp.textContent = 'TERVALIDASI';
            stamp.style.transform = 'translate(-50%, -50%) rotate(-12deg) scale(1.1)';
            
            // Play a soft bounce animation on stamp
            setTimeout(() => {
                stamp.style.transform = 'translate(-50%, -50%) rotate(-12deg) scale(1)';
            }, 200);

            // Pop success modal
            showSuccessModal(
                "Draf Surat Siap!",
                "Draf administrasi Anda telah berhasil dibuat dalam sistem. Anda dapat mencetaknya langsung atau menyimpannya sebagai file cadangan untuk dibawa ke Balai Desa."
            );

            btn.disabled = false;
        }, 1500);
    });

    // Printing function: Opens print frame of just the letter
    const printLetter = () => {
        const printContent = virtualLetter.innerHTML;
        const originalContent = document.body.innerHTML;
        
        // Premium Print Window styling
        const printWindow = window.open('', '_blank', 'width=800,height=900');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak Surat Keterangan - Desa Makmur Sentosa</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <style>
                        body {
                            font-family: 'Times New Roman', Times, serif;
                            color: #000;
                            padding: 40px;
                            background: white;
                            line-height: 1.5;
                        }
                        .virtual-letter {
                            width: 100%;
                            padding: 20px;
                        }
                        .letter-header {
                            display: flex;
                            align-items: center;
                            gap: 16px;
                            margin-bottom: 12px;
                        }
                        .letter-logo {
                            font-size: 38px;
                            color: #000 !important;
                            display: block;
                        }
                        .letter-header-text {
                            text-align: center;
                            flex-grow: 1;
                        }
                        .letter-header-text h4 { margin: 0; font-size: 14px; font-weight: bold; }
                        .letter-header-text h5 { margin: 2px 0; font-size: 12px; font-weight: bold; }
                        .letter-header-text h3 { margin: 2px 0; font-size: 16px; font-weight: 900; }
                        .letter-sub { font-size: 10px; margin: 0; }
                        .letter-divider { border: none; border-top: 3px double #000; margin: 10px 0 20px; }
                        .letter-title { text-align: center; margin-bottom: 24px; }
                        .letter-title h4 { font-size: 15px; font-weight: bold; text-decoration: underline; margin: 0 0 4px; }
                        .letter-title p { font-size: 12px; margin: 0; }
                        .letter-body { font-size: 12px; text-align: justify; }
                        .letter-body p { margin-bottom: 14px; text-indent: 30px; }
                        .letter-table { width: 100%; margin: 15px 0 20px 30px; border-collapse: collapse; }
                        .letter-table td { padding: 5px 2px; vertical-align: top; font-size: 12px; }
                        .letter-signature { float: right; width: 200px; text-align: center; margin-top: 30px; font-size: 12px; }
                        .letter-signature p { margin: 0; }
                        .sign-role { font-weight: bold; margin-bottom: 60px !important; }
                        .sign-space { height: 60px; position: relative; }
                        .virtual-stamp {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%) rotate(-12deg);
                            border: 2px dashed #000;
                            border-radius: 4px;
                            color: #000;
                            padding: 3px 10px;
                            font-size: 9px;
                            font-weight: bold;
                        }
                        .sign-name { font-weight: bold; text-decoration: underline; }
                        @media print {
                            body { padding: 0; }
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body onload="window.print(); window.close();">
                    <div class="virtual-letter">
                        ${printContent}
                    </div>
                </body>
            </html>
        `);
        printWindow.document.close();
    };

    document.getElementById('btnPrintLetter').addEventListener('click', printLetter);

    // Mock Download PDF Action
    document.getElementById('btnDownloadPDF').addEventListener('click', () => {
        const btn = document.getElementById('btnDownloadPDF');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Mengompresi PDF...`;
        btn.disabled = true;

        setTimeout(() => {
            // Generate a simple TXT blob to simulate download
            const name = prevName.textContent;
            const docTitle = prevTitle.textContent;
            const letterText = `
==================================================
KANTOR KEPALA DESA MAKMUR SENTOSA
DRAFT LAYANAN SURAT MANDIRI ONLINE
==================================================
Tipe Surat: ${docTitle}
Nomor     : 503 / ${prevNumber.textContent} / VIII / 2026

Nama      : ${name}
NIK       : ${prevNik.textContent}
Alamat    : ${prevAddress.textContent}
${prevDynamicLabel.textContent} : ${prevDynamicValue.textContent}

--------------------------------------------------
Status Draf: TERVALIDASI SYSTEM DIGITAL
Gunakan file draf ini untuk ditukarkan ke 
petugas administrasi kantor desa untuk cetak resmi.
==================================================
            `;
            
            const blob = new Blob([letterText], { type: 'text/plain;charset=utf-8' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `Draft_${docTitle.replace(/\s+/g, '_')}_${name.replace(/\s+/g, '_')}.txt`;
            link.click();

            btn.innerHTML = `<i class="fa-solid fa-circle-down"></i> Unduh Berhasil`;
            btn.style.background = '#0284c7';
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.disabled = false;
            }, 2000);
        }, 1200);
    });


    /* ==========================================
       5. INTERACTIVE MAP PINS TRIGGER
       ========================================== */
    const mapPins = document.querySelectorAll('.map-pin');
    const pinTitle = document.getElementById('pinTitle');
    const pinDesc = document.getElementById('pinDesc');

    mapPins.forEach(pin => {
        pin.addEventListener('click', () => {
            // Remove active status from all map pins
            mapPins.forEach(p => p.classList.remove('active'));
            pin.classList.add('active');

            const title = pin.getAttribute('data-title');
            const desc = pin.getAttribute('data-desc');

            // Soft transition on detail box texts
            pinTitle.style.opacity = '0';
            pinDesc.style.opacity = '0';

            setTimeout(() => {
                pinTitle.innerHTML = `<i class="fa-solid fa-location-dot"></i> ${title}`;
                pinDesc.textContent = desc;
                
                pinTitle.style.opacity = '1';
                pinDesc.style.opacity = '1';
            }, 200);
        });
    });


    /* ==========================================
       6. CONTACT FORM HANDLING & SUCCESS MODAL
       ========================================== */
    const contactForm = document.getElementById('contactForm');
    const successModal = document.getElementById('successModal');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');

    const showSuccessModal = (title, message) => {
        modalTitle.textContent = title;
        modalMessage.textContent = message;
        successModal.classList.add('active');
    };

    const hideSuccessModal = () => {
        successModal.classList.remove('active');
    };

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const submitBtn = document.getElementById('btnSubmitContact');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = `<span>Mengirimkan...</span> <i class="fa-solid fa-spinner fa-spin"></i>`;
            submitBtn.disabled = true;

            const formData = new FormData(contactForm);

            // AJAX request to Laravel controller
            fetch('/aspirasi', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                showSuccessModal(
                    "Pesan Terkirim!",
                    data.message
                );
                contactForm.reset();
            })
            .catch(error => {
                const errMsg = error.message || "Gagal menghubungkan ke server. Silakan cek koneksi Anda.";
                showSuccessModal(
                    "Pengiriman Gagal",
                    errMsg
                );
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    if (btnCloseModal) {
        btnCloseModal.addEventListener('click', hideSuccessModal);
    }

    // Close modal on clicking backdrop
    if (successModal) {
        successModal.addEventListener('click', (e) => {
            if (e.target === successModal) {
                hideSuccessModal();
            }
        });
    }
});
