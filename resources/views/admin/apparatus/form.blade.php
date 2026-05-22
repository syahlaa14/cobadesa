@extends('layouts.admin')

@section('title', $apparatus->exists ? 'Edit Aparatur Desa' : 'Tambah Aparatur Desa')
@section('page_heading', 'Formulir Aparatur')
@section('page_subheading', $apparatus->exists ? 'Perbarui informasi data aparatur desa.' : 'Formulir pendaftaran aparatur desa baru.')

@section('content')
    <div class="panel-card" style="max-width: 800px; margin: 0 auto;">
        <div class="panel-header" style="border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h2 class="panel-title">
                <i class="fa-solid {{ $apparatus->exists ? 'fa-user-pen' : 'fa-user-plus' }}" style="margin-right: 8px; color: var(--accent-color);"></i>
                {{ $apparatus->exists ? 'Edit Data Aparatur' : 'Tambah Data Aparatur Baru' }}
            </h2>
        </div>

        <form action="{{ $apparatus->exists ? route('admin.apparatus.update', $apparatus->id) : route('admin.apparatus.store') }}" method="POST">
            @csrf
            @if($apparatus->exists)
                @method('PUT')
            @endif

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap & Gelar</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Contoh: Drs. Bambang Wijaya, M.Si" 
                    value="{{ old('name', $apparatus->name) }}" 
                    required
                >
                @error('name')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Role/Jabatan -->
            <div class="form-group">
                <label for="role" class="form-label">Jabatan Struktural</label>
                <input 
                    type="text" 
                    name="role" 
                    id="role" 
                    class="form-control @error('role') is-invalid @enderror" 
                    placeholder="Contoh: Kepala Desa / Sekretaris Desa / Kasi Pelayanan" 
                    value="{{ old('role', $apparatus->role) }}" 
                    required
                >
                @error('role')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- FontAwesome Icon -->
            <div class="form-group">
                <label for="icon" class="form-label">Ikon Perwakilan (FontAwesome class)</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input 
                        type="text" 
                        name="icon" 
                        id="icon" 
                        class="form-control @error('icon') is-invalid @enderror" 
                        placeholder="Contoh: fa-user-tie, fa-building-user, fa-user-shield" 
                        value="{{ old('icon', $apparatus->icon ?? 'fa-user') }}" 
                        required
                    >
                    <span style="font-size: 1.5rem; color: var(--accent-color); min-width: 40px; text-align: center;">
                        <i class="fa-solid {{ old('icon', $apparatus->icon ?? 'fa-user') }}" id="iconPreview"></i>
                    </span>
                </div>
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Gunakan class dari FontAwesome 6 (solid). Contoh: `fa-user-tie` (Kepala Desa/Laki-laki), `fa-user-graduate` (Pendidikan), `fa-shield-halved` (Keamanan).
                </small>
                @error('icon')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="desc" class="form-label">Tugas / Deskripsi Singkat</label>
                <textarea 
                    name="desc" 
                    id="desc" 
                    rows="4" 
                    class="form-control @error('desc') is-invalid @enderror" 
                    placeholder="Deskripsikan secara singkat fungsi jabatan atau profil dinas yang bersangkutan..." 
                    required
                >{{ old('desc', $apparatus->desc) }}</textarea>
                @error('desc')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email Kontak (Opsional)</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Contoh: bambang@desa.go.id" 
                    value="{{ old('email', $apparatus->email) }}"
                >
                @error('email')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Facebook -->
                <div class="form-group">
                    <label for="facebook" class="form-label">Profil Facebook (Opsional URL)</label>
                    <input 
                        type="url" 
                        name="facebook" 
                        id="facebook" 
                        class="form-control @error('facebook') is-invalid @enderror" 
                        placeholder="Contoh: https://facebook.com/username" 
                        value="{{ old('facebook', $apparatus->facebook) }}"
                    >
                    @error('facebook')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Instagram -->
                <div class="form-group">
                    <label for="instagram" class="form-label">Profil Instagram (Opsional URL)</label>
                    <input 
                        type="url" 
                        name="instagram" 
                        id="instagram" 
                        class="form-control @error('instagram') is-invalid @enderror" 
                        placeholder="Contoh: https://instagram.com/username" 
                        value="{{ old('instagram', $apparatus->instagram) }}"
                    >
                    @error('instagram')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Action buttons -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                <a href="{{ route('admin.apparatus.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
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
            
            if (iconInput && iconPreview) {
                iconInput.addEventListener('input', function() {
                    const iconName = iconInput.value.trim();
                    // Reset to default if empty
                    if (iconName === '') {
                        iconPreview.className = 'fa-solid fa-user';
                    } else {
                        // Apply class
                        iconPreview.className = 'fa-solid ' + iconName;
                    }
                });
            }
        });
    </script>
@endsection
