@extends('layouts.admin')

@section('title', $tourism->exists ? 'Edit Destinasi Wisata' : 'Tambah Destinasi Wisata')
@section('page_heading', 'Formulir Wisata & Budaya')
@section('page_subheading', $tourism->exists ? 'Perbarui informasi detail destinasi wisata.' : 'Tambahkan destinasi atau fasilitas pariwisata baru.')

@section('content')
    <div class="panel-card" style="max-width: 800px; margin: 0 auto;">
        <div class="panel-header" style="border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h2 class="panel-title">
                <i class="fa-solid {{ $tourism->exists ? 'fa-map-location-dot' : 'fa-map-location-dot' }}" style="margin-right: 8px; color: var(--accent-color);"></i>
                {{ $tourism->exists ? 'Edit Destinasi Wisata' : 'Tambah Destinasi Wisata Baru' }}
            </h2>
        </div>

        <form action="{{ $tourism->exists ? route('admin.tourism.update', $tourism->id) : route('admin.tourism.store') }}" method="POST">
            @csrf
            @if($tourism->exists)
                @method('PUT')
            @endif

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label">Nama Destinasi Wisata</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="form-control @error('title') is-invalid @enderror" 
                    placeholder="Contoh: Air Terjun Wono Lestari, Bukit Sendang" 
                    value="{{ old('title', $tourism->title) }}" 
                    required
                >
                @error('title')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Category Label -->
                <div class="form-group">
                    <label for="category_label" class="form-label">Nama/Label Kategori</label>
                    <input 
                        type="text" 
                        name="category_label" 
                        id="category_label" 
                        class="form-control @error('category_label') is-invalid @enderror" 
                        placeholder="Contoh: Wisata Alam, Budaya & Tradisi" 
                        value="{{ old('category_label', $tourism->category_label) }}" 
                        required
                    >
                    @error('category_label')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Category Slug -->
                <div class="form-group">
                    <label for="category" class="form-label">Slug Kategori (URL friendly)</label>
                    <input 
                        type="text" 
                        name="category" 
                        id="category" 
                        class="form-control @error('category') is-invalid @enderror" 
                        placeholder="Contoh: wisata-alam, budaya-tradisi" 
                        value="{{ old('category', $tourism->category) }}" 
                        required
                    >
                    @error('category')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- FontAwesome Icon -->
            <div class="form-group">
                <label for="icon" class="form-label">Ikon Representasi (FontAwesome class)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input 
                        type="text" 
                        name="icon" 
                        id="icon" 
                        class="form-control @error('icon') is-invalid @enderror" 
                        placeholder="Contoh: fa-mountain, fa-water, fa-hotel, fa-tree" 
                        value="{{ old('icon', $tourism->icon ?? 'fa-map-pin') }}" 
                        required
                    >
                    <span style="font-size: 1.5rem; color: #8b5cf6; min-width: 40px; text-align: center;">
                        <i class="fa-solid {{ old('icon', $tourism->icon ?? 'fa-map-pin') }}" id="iconPreview"></i>
                    </span>
                </div>
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Gunakan class dari FontAwesome 6. Contoh: `fa-mountain` (gunung/bukit), `fa-water` (air terjun/danau), `fa-hotel` (penginapan), `fa-utensils` (kuliner).
                </small>
                @error('icon')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="desc" class="form-label">Deskripsi Lengkap Wisata</label>
                <textarea 
                    name="desc" 
                    id="desc" 
                    rows="6" 
                    class="form-control @error('desc') is-invalid @enderror" 
                    placeholder="Tuliskan cerita sejarah singkat, letak geografis, fasilitas yang tersedia, tiket masuk, atau akses jalan menuju destinasi wisata tersebut secara lengkap..." 
                    required
                >{{ old('desc', $tourism->desc) }}</textarea>
                @error('desc')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                <a href="{{ route('admin.tourism.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Destinasi
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('iconPreview');
            const categoryLabel = document.getElementById('category_label');
            const categorySlug = document.getElementById('category');
            
            // Icon Preview logic
            if (iconInput && iconPreview) {
                iconInput.addEventListener('input', function() {
                    const iconName = iconInput.value.trim();
                    if (iconName === '') {
                        iconPreview.className = 'fa-solid fa-map-pin';
                    } else {
                        iconPreview.className = 'fa-solid ' + iconName;
                    }
                });
            }

            // Slug Auto-generation logic (only when creating new)
            @if(!$tourism->exists)
                if (categoryLabel && categorySlug) {
                    categoryLabel.addEventListener('input', function() {
                        const labelValue = categoryLabel.value;
                        const slugValue = labelValue.toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '') // remove invalid chars
                            .replace(/\s+/g, '-')          // collapse whitespace and replace by -
                            .replace(/-+/g, '-');          // collapse dashes
                        categorySlug.value = slugValue;
                    });
                }
            @endif
        });
    </script>
@endsection
