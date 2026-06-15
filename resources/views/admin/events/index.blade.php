@extends('layouts.admin')

@section('title', 'Kelola Kegiatan Desa')
@section('page_heading', 'Kegiatan & Acara Desa')
@section('page_subheading', 'Manajemen jadwal kegiatan, acara, rapat, dan rencana pembangunan Desa Pasir Kulon.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-calendar-days" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Kegiatan Desa</h2>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Kegiatan
            </a>
        </div>

        <!-- Search Filter -->
        <form action="{{ route('admin.events.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari kegiatan atau lokasi..." 
                value="{{ $search ?? '' }}"
            >
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(!empty($search))
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($events->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-solid fa-calendar-days" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Belum ada jadwal kegiatan desa. Silakan tambahkan kegiatan baru.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 1rem;">{{ $item->judul }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary); max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $item->deskripsi }}
                                    </div>
                                </td>
                                <td>
                                    @if($item->tanggal_mulai === $item->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                    @endif
                                </td>
                                <td>
                                    {{ $item->lokasi }}
                                </td>
                                <td>
                                    @if($item->status === 'rencana')
                                        <span class="badge badge-info">Rencana</span>
                                    @elseif($item->status === 'berjalan')
                                        <span class="badge badge-warning" style="background: #eab308; color: white;">Berjalan</span>
                                    @else
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.events.edit', $item->id) }}" class="btn btn-secondary btn-sm" title="Edit Kegiatan">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Kegiatan">
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
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection
