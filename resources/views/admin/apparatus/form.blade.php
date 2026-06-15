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

        <form action="{{ $apparatus->exists ? route('admin.apparatus.update', $apparatus->id) : route('admin.apparatus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($apparatus->exists)
                @method('PUT')
            @endif

            <!-- Nama -->
            <div class="form-group">
                <label for="nama" class="form-label">Nama Lengkap & Gelar</label>
                <input 
                    type="text" 
                    name="nama" 
                    id="nama" 
                    class="form-control @error('nama') is-invalid @enderror" 
                    placeholder="Contoh: Drs. Bambang Wijaya, M.Si" 
                    value="{{ old('nama', $apparatus->nama) }}" 
                    required
                >
                @error('nama')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Jabatan -->
            <div class="form-group">
                <label for="jabatan" class="form-label">Jabatan Struktural</label>
                <input 
                    type="text" 
                    name="jabatan" 
                    id="jabatan" 
                    class="form-control @error('jabatan') is-invalid @enderror" 
                    placeholder="Contoh: Kepala Desa / Sekretaris Desa / Kasi Pelayanan" 
                    value="{{ old('jabatan', $apparatus->jabatan) }}" 
                    required
                >
                @error('jabatan')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- NIP (Opsional) -->
            <div class="form-group">
                <label for="nip" class="form-label">NIP (Opsional)</label>
                <input 
                    type="text" 
                    name="nip" 
                    id="nip" 
                    class="form-control @error('nip') is-invalid @enderror" 
                    placeholder="Contoh: 198012012010011002" 
                    value="{{ old('nip', $apparatus->nip) }}" 
                >
                @error('nip')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- SK Pengangkatan (Opsional) & Tanggal SK (Opsional) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="sk_pengangkatan" class="form-label">SK Pengangkatan (Opsional)</label>
                    <input 
                        type="text" 
                        name="sk_pengangkatan" 
                        id="sk_pengangkatan" 
                        class="form-control @error('sk_pengangkatan') is-invalid @enderror" 
                        placeholder="Contoh: 141/12/2022" 
                        value="{{ old('sk_pengangkatan', $apparatus->sk_pengangkatan) }}" 
                    >
                    @error('sk_pengangkatan')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_sk" class="form-label">Tanggal SK (Opsional)</label>
                    <input 
                        type="date" 
                        name="tanggal_sk" 
                        id="tanggal_sk" 
                        class="form-control @error('tanggal_sk') is-invalid @enderror" 
                        value="{{ old('tanggal_sk', $apparatus->tanggal_sk ? $apparatus->tanggal_sk->format('Y-m-d') : '') }}" 
                    >
                    @error('tanggal_sk')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Ikon / Foto -->
            <div class="form-group">
                <label for="foto" class="form-label">Ikon Perwakilan (FontAwesome class) / URL Foto</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input 
                        type="text" 
                        name="foto" 
                        id="foto" 
                        class="form-control @error('foto') is-invalid @enderror" 
                        placeholder="Contoh: fa-user-tie, fa-building-user, fa-user-shield" 
                        value="{{ old('foto', $apparatus->foto ?? 'fa-user') }}" 
                        required
                    >
                    <span style="font-size: 1.5rem; color: var(--accent-color); min-width: 40px; text-align: center;">
                        <i class="fa-solid {{ old('foto', $apparatus->foto ?? 'fa-user') }}" id="fotoPreview"></i>
                    </span>
                </div>
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Gunakan class dari FontAwesome 6 (solid). Contoh: `fa-user-tie` (Kepala Desa/Laki-laki), `fa-user-graduate` (Pendidikan), `fa-shield-halved` (Keamanan).
                </small>
                @error('foto')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Foto Aparatur -->
            <div class="form-group">
                <label for="foto_file" class="form-label">Unggah Foto Resmi Aparatur (Pilihan)</label>
                <input 
                    type="file" 
                    name="foto_file" 
                    id="foto_file" 
                    class="form-control @error('foto_file') is-invalid @enderror" 
                    accept="image/*"
                >
                @if($apparatus->foto && \Illuminate\Support\Str::startsWith($apparatus->foto, 'uploads/'))
                    <div style="margin-top: 10px;">
                        <span style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 4px;">Foto saat ini:</span>
                        <img src="{{ asset($apparatus->foto) }}" alt="Foto Aparatur" style="max-height: 150px; border-radius: 8px; border: 1px solid var(--border-color);">
                    </div>
                @endif
                <small style="color: var(--text-muted); display: block; margin-top: 6px;">
                    Format berkas: JPG, JPEG, PNG, WEBP. Maksimal ukuran 2MB. Jika mengunggah foto, ikon FontAwesome di atas akan diabaikan pada halaman publik.
                </small>
                @error('foto_file')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Keterangan Jabatan / Deskripsi -->
            <div class="form-group">
                <label for="keterangan_jabatan" class="form-label">Tugas / Deskripsi Singkat</label>
                <textarea 
                    name="keterangan_jabatan" 
                    id="keterangan_jabatan" 
                    rows="4" 
                    class="form-control @error('keterangan_jabatan') is-invalid @enderror" 
                    placeholder="Deskripsikan secara singkat fungsi jabatan atau profil dinas yang bersangkutan..." 
                    required
                >{{ old('keterangan_jabatan', $apparatus->keterangan_jabatan) }}</textarea>
                @error('keterangan_jabatan')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <input 
                    type="checkbox" 
                    name="status_aktif" 
                    id="status_aktif" 
                    value="1" 
                    style="width: 18px; height: 18px; cursor: pointer;"
                    {{ old('status_aktif', $apparatus->exists ? $apparatus->status_aktif : 1) ? 'checked' : '' }}
                >
                <label for="status_aktif" class="form-label" style="margin-bottom: 0; cursor: pointer;">Aparatur Aktif dalam Pemerintahan</label>
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
            const fotoInput = document.getElementById('foto');
            const fotoPreview = document.getElementById('fotoPreview');
            
            if (fotoInput && fotoPreview) {
                fotoInput.addEventListener('input', function() {
                    const iconName = fotoInput.value.trim();
                    // Reset to default if empty
                    if (iconName === '') {
                        fotoPreview.className = 'fa-solid fa-user';
                    } else if (iconName.startsWith('fa-')) {
                        // Apply class
                        fotoPreview.className = 'fa-solid ' + iconName;
                    }
                });
            }
        });
    </script>
@endsection
