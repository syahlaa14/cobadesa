@extends('layouts.admin')

@section('title', 'Kelola Berita Desa')
@section('page_heading', 'Berita & Pengumuman Desa')
@section('page_subheading', 'Manajemen publikasi berita, pengumuman, dan informasi terbaru Desa Pasir Kulon.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-newspaper" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Berita</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Berita
            </a>
        </div>

        <!-- Search Filter -->
        <form action="{{ route('admin.news.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari judul berita..." 
                value="{{ $search ?? '' }}"
            >
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(!empty($search))
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($news->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Belum ada berita yang diterbitkan. Silakan tambahkan berita baru.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul Berita</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Terakhir Diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 1rem;">{{ $item->judul }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary); max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ Str::limit(strip_tags($item->konten), 100) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $item->kategori->nama ?? 'Umum' }}</span>
                                </td>
                                <td>
                                    {{ $item->user->name ?? 'Admin' }}
                                </td>
                                <td>
                                    @if($item->status === 'published')
                                        <span class="badge badge-success">Diterbitkan</span>
                                    @else
                                        <span class="badge badge-warning" style="background: #eab308; color: white;">Draft</span>
                                    @endif
                                </td>
                                <td style="color: var(--text-secondary);">
                                    {{ $item->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-secondary btn-sm" title="Edit Berita">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Berita">
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
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection
