@extends('layouts.admin')

@section('title', $berita->exists ? 'Edit Berita' : 'Tambah Berita')
@section('page_heading', 'Formulir Berita Desa')
@section('page_subheading', $berita->exists ? 'Perbarui informasi detail artikel berita.' : 'Tulis dan publikasikan berita baru untuk warga.')

@section('content')
    <div class="panel-card" style="max-width: 800px; margin: 0 auto;">
        <div class="panel-header" style="border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h2 class="panel-title">
                <i class="fa-solid fa-newspaper" style="margin-right: 8px; color: var(--accent-color);"></i>
                {{ $berita->exists ? 'Edit Berita' : 'Tambah Berita Baru' }}
            </h2>
        </div>

        <form action="{{ $berita->exists ? route('admin.news.update', $berita->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($berita->exists)
                @method('PUT')
            @endif

            <!-- Title -->
            <div class="form-group">
                <label for="judul" class="form-label">Judul Berita / Pengumuman</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="form-control @error('judul') is-invalid @enderror" 
                    placeholder="Contoh: Pembagian Bansos Sembako Tahap III, Kerja Bakti Warga RT 01" 
                    value="{{ old('judul', $berita->judul) }}" 
                    required
                >
                @error('judul')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Category Select -->
                <div class="form-group">
                    <label for="kategori_id" class="form-label">Kategori Berita</label>
                    <select 
                        name="kategori_id" 
                        id="kategori_id" 
                        class="form-control @error('kategori_id') is-invalid @enderror" 
                        required
                    >
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('kategori_id', $berita->kategori_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="form-label">Status Publikasi</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-control @error('status') is-invalid @enderror" 
                        required
                    >
                        <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft (Simpan Internal)</option>
                        <option value="published" {{ old('status', $berita->status) === 'published' ? 'selected' : '' }}>Published (Tampilkan ke Publik)</option>
                    </select>
                    @error('status')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- FontAwesome Icon / Image URL for gambar -->
            <div class="form-group">
                <label for="gambar" class="form-label">Ikon / Gambar Representasi (FontAwesome class atau URL Gambar)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input 
                        type="text" 
                        name="gambar" 
                        id="gambar" 
                        class="form-control @error('gambar') is-invalid @enderror" 
                        placeholder="Contoh: fa-bullhorn, fa-hand-holding-dollar, fa-road, fa-person-digging" 
                        value="{{ old('gambar', $berita->gambar ?? 'fa-newspaper') }}" 
                        required
                    >
                    <span style="font-size: 1.5rem; color: #8b5cf6; min-width: 40px; text-align: center;">
                        <i class="fa-solid {{ old('gambar', $berita->gambar ?? 'fa-newspaper') }}" id="gambarPreview"></i>
                    </span>
                </div>
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Gunakan class dari FontAwesome 6 (seperti `fa-bullhorn`, `fa-hand-holding-dollar`, `fa-road`, `fa-circle-info`) untuk memudahkan pengelolaan visual tanpa ribet mengunggah berkas gambar.
                </small>
                @error('gambar')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Foto Berita -->
            <div class="form-group">
                <label for="foto" class="form-label">Unggah Foto Berita (Pilihan)</label>
                <input 
                    type="file" 
                    name="foto" 
                    id="foto" 
                    class="form-control @error('foto') is-invalid @enderror" 
                    accept="image/*"
                >
                @if($berita->gambar && \Illuminate\Support\Str::startsWith($berita->gambar, 'uploads/'))
                    <div style="margin-top: 10px;">
                        <span style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 4px;">Foto saat ini:</span>
                        <img src="{{ asset($berita->gambar) }}" alt="Foto Berita" style="max-height: 150px; border-radius: 8px; border: 1px solid var(--border-color);">
                    </div>
                @endif
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Format berkas: JPG, JPEG, PNG, WEBP, atau SVG. Maksimal ukuran 2MB. Jika mengunggah foto, ikon FontAwesome di atas akan diabaikan pada halaman publik.
                </small>
                @error('foto')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Content Konten -->
            <div class="form-group">
                <label for="konten" class="form-label">Isi / Konten Berita Lengkap</label>
                <textarea 
                    name="konten" 
                    id="konten" 
                    rows="8" 
                    class="form-control @error('konten') is-invalid @enderror" 
                    placeholder="Tuliskan berita lengkap di sini..." 
                    required
                >{{ old('konten', $berita->konten) }}</textarea>
                @error('konten')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Berita
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gambarInput = document.getElementById('gambar');
            const gambarPreview = document.getElementById('gambarPreview');
            
            // Icon Preview logic
            if (gambarInput && gambarPreview) {
                gambarInput.addEventListener('input', function() {
                    const iconName = gambarInput.value.trim();
                    if (iconName === '' || iconName.startsWith('http')) {
                        gambarPreview.className = 'fa-solid fa-newspaper';
                    } else {
                        gambarPreview.className = 'fa-solid ' + iconName;
                    }
                });
            }
        });
    </script>
@endsection
