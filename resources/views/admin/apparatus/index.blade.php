@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa')
@section('page_heading', 'Perangkat Desa')
@section('page_subheading', 'Manajemen data pejabat, staf, dan aparatur pemerintahan Desa Makmur Sentosa.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-users-gear" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Aparatur Desa</h2>
            <a href="{{ route('admin.apparatus.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Tambah Aparatur
            </a>
        </div>

        <!-- Search Filter -->
        <form action="{{ route('admin.apparatus.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari nama atau jabatan..." 
                value="{{ $search ?? '' }}"
            >
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(!empty($search))
                <a href="{{ route('admin.apparatus.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($apparatuses->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-solid fa-users-slash" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Data aparatur tidak ditemukan. Silakan tambahkan data baru.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Ikon Representasi</th>
                            <th>Email & Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apparatuses as $person)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 1rem;">{{ $person->name }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $person->desc }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $person->role }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 1.2rem; color: var(--accent-color); padding: 8px; background: rgba(99, 102, 241, 0.1); border-radius: 8px; display: inline-flex;">
                                        <i class="fa-solid {{ $person->icon }}"></i>
                                    </span>
                                    <span style="font-size: 0.8rem; color: var(--text-muted); margin-left: 6px;">{{ $person->icon }}</span>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem; display: flex; flex-direction: column; gap: 4px;">
                                        @if($person->email)
                                            <span><i class="fa-regular fa-envelope" style="width: 16px;"></i> {{ $person->email }}</span>
                                        @endif
                                        <div style="display: flex; gap: 8px; margin-top: 4px;">
                                            @if($person->facebook)
                                                <a href="{{ $person->facebook }}" target="_blank" style="color: #1877f2;"><i class="fa-brands fa-facebook"></i></a>
                                            @endif
                                            @if($person->instagram)
                                                <a href="{{ $person->instagram }}" target="_blank" style="color: #e1306c;"><i class="fa-brands fa-instagram"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.apparatus.edit', $person->id) }}" class="btn btn-secondary btn-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.apparatus.destroy', $person->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $person->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
                                                <i class="fa-solid fa-trash-can"></i> Haps
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
                {{ $apparatuses->links() }}
            </div>
        @endif
    </div>
@endsection
