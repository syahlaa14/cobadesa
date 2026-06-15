@extends('layouts.admin')

@section('title', 'Kelola Destinasi Wisata')
@section('page_heading', 'Destinasi Wisata & Budaya')
@section('page_subheading', 'Manajemen daya tarik pariwisata, sejarah, budaya, dan sarana rekreasi Desa Pasir Kulon.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-umbrella-beach" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Destinasi Wisata</h2>
            <a href="{{ route('admin.tourism.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Destinasi
            </a>
        </div>

        <!-- Search Filter -->
        <form action="{{ route('admin.tourism.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari wisata atau kategori..." 
                value="{{ $search ?? '' }}"
            >
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(!empty($search))
                <a href="{{ route('admin.tourism.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($tourisms->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-solid fa-map-pin" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Destinasi wisata tidak ditemukan. Silakan tambahkan data baru.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Destinasi</th>
                            <th>Kategori & Label</th>
                            <th>Ikon Representasi</th>
                            <th>Terakhir Diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tourisms as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 1rem;">{{ $item->title }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary); max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $item->desc }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $item->category_label }}</span>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Slug: <code>{{ $item->category }}</code></div>
                                </td>
                                <td>
                                    <span style="font-size: 1.2rem; color: #8b5cf6; padding: 8px; background: rgba(139, 92, 246, 0.1); border-radius: 8px; display: inline-flex;">
                                        <i class="fa-solid {{ $item->icon }}"></i>
                                    </span>
                                    <span style="font-size: 0.8rem; color: var(--text-muted); margin-left: 6px;">{{ $item->icon }}</span>
                                </td>
                                <td style="color: var(--text-secondary);">
                                    {{ $item->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.tourism.edit', $item->id) }}" class="btn btn-secondary btn-sm" title="Edit Destinasi">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.tourism.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pariwisata {{ $item->title }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Destinasi">
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Laravel simple pagination render -->
            <div class="pagination-container">
                {{ $tourisms->links() }}
            </div>
        @endif
    </div>
@endsection
