@extends('layouts.admin')

@section('title', 'Kelola Surat Pengajuan Warga')
@section('page_heading', 'Surat Pengajuan')
@section('page_subheading', 'Verifikasi, setujui, atau tolak surat keterangan yang diajukan oleh warga secara mandiri online.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-file-shield" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Surat Masuk</h2>
        </div>

        <!-- Search & Filter Panel -->
        <form action="{{ route('admin.surat.index') }}" method="GET" class="search-form" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari nama, NIK, atau nomor surat..." 
                value="{{ $search ?? '' }}"
                style="flex-grow: 1; min-width: 250px;"
            >
            <select name="status" class="form-control" style="width: 180px; padding: 10px; border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary);">
                <option value="">Semua Status</option>
                <option value="pending" {{ ($status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ ($status ?? '') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ ($status ?? '') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            @if(!empty($search) || !empty($status))
                <a href="{{ route('admin.surat.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($suratList->isEmpty())
            <div style="text-align: center; padding: 60px 20px; color: var(--text-muted);">
                <i class="fa-regular fa-folder-open" style="font-size: 3rem; margin-bottom: 16px; display: block; color: var(--accent-color);"></i>
                <p>Belum ada pengajuan surat yang terdaftar atau sesuai kriteria pencarian.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No. Surat / Pengajuan</th>
                            <th>Warga Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratList as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 0.95rem;">{{ $item->nomor_surat }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 2px;">
                                        Diajukan: {{ $item->tanggal_pengajuan->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $item->penduduk->nama_lengkap }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary);">NIK: {{ $item->penduduk->nik }}</div>
                                </td>
                                <td>
                                    <span style="font-weight: 500; font-size: 0.9rem;">{{ $item->jenisSurat->nama_surat }}</span>
                                </td>
                                <td>
                                    @if($item->status === 'pending')
                                        <span class="badge badge-warning" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); font-weight: 600;"><i class="fa-solid fa-clock-rotate-left"></i> Pending</span>
                                    @elseif($item->status === 'disetujui')
                                        <span class="badge badge-success" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                    @else
                                        <span class="badge badge-danger" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); font-weight: 600;"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.surat.show', $item->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.surat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pengajuan">
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

            <!-- Pagination -->
            <div class="pagination-container" style="margin-top: 24px;">
                {{ $suratList->links() }}
            </div>
        @endif
    </div>
@endsection
