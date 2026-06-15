@extends('layouts.admin')

@section('title', $event->exists ? 'Edit Kegiatan Desa' : 'Tambah Kegiatan Desa')
@section('page_heading', 'Formulir Kegiatan Desa')
@section('page_subheading', $event->exists ? 'Perbarui jadwal dan detail agenda kegiatan.' : 'Jadwalkan kegiatan atau acara kemasyarakatan baru.')

@section('content')
    <div class="panel-card" style="max-width: 800px; margin: 0 auto;">
        <div class="panel-header" style="border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h2 class="panel-title">
                <i class="fa-solid fa-calendar-days" style="margin-right: 8px; color: var(--accent-color);"></i>
                {{ $event->exists ? 'Edit Kegiatan' : 'Jadwalkan Kegiatan Baru' }}
            </h2>
        </div>

        <form action="{{ $event->exists ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST">
            @csrf
            @if($event->exists)
                @method('PUT')
            @endif

            <!-- Title -->
            <div class="form-group">
                <label for="judul" class="form-label">Nama / Judul Kegiatan</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="form-control @error('judul') is-invalid @enderror" 
                    placeholder="Contoh: Musrenbangdes 2026, Pelatihan Posyandu Lansia" 
                    value="{{ old('judul', $event->judul) }}" 
                    required
                >
                @error('judul')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Date range (Start & End) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input 
                        type="date" 
                        name="tanggal_mulai" 
                        id="tanggal_mulai" 
                        class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                        value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}" 
                        required
                    >
                    @error('tanggal_mulai')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input 
                        type="date" 
                        name="tanggal_selesai" 
                        id="tanggal_selesai" 
                        class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                        value="{{ old('tanggal_selesai', $event->tanggal_selesai) }}" 
                        required
                    >
                    @error('tanggal_selesai')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 20px;">
                <!-- Location -->
                <div class="form-group">
                    <label for="lokasi" class="form-label">Lokasi Kegiatan</label>
                    <input 
                        type="text" 
                        name="lokasi" 
                        id="lokasi" 
                        class="form-control @error('lokasi') is-invalid @enderror" 
                        placeholder="Contoh: Balai Desa Pasir Kulon, PKD Desa" 
                        value="{{ old('lokasi', $event->lokasi) }}" 
                        required
                    >
                    @error('lokasi')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="form-label">Status Kegiatan</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-control @error('status') is-invalid @enderror" 
                        required
                    >
                        <option value="rencana" {{ old('status', $event->status) === 'rencana' ? 'selected' : '' }}>Rencana / Terjadwal</option>
                        <option value="berjalan" {{ old('status', $event->status) === 'berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                        <option value="selesai" {{ old('status', $event->status) === 'selesai' ? 'selected' : '' }}>Selesai / Lampau</option>
                    </select>
                    @error('status')
                        <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="deskripsi" class="form-label">Deskripsi Lengkap Kegiatan</label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    rows="6" 
                    class="form-control @error('deskripsi') is-invalid @enderror" 
                    placeholder="Tuliskan detail pelaksanaan kegiatan, agenda, narasumber, atau persyaratan keikutsertaan warga..." 
                    required
                >{{ old('deskripsi', $event->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="form-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <!-- Action buttons -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
@endsection
