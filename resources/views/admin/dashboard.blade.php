@extends('layouts.admin')

@section('title')
    Dashboard Admin
@endsection

@section('page_heading', 'Dashboard Administrasi')
@section('page_subheading', 'Ikhtisar statistik dan aktivitas terbaru sistem profil desa.')

@section('content')
    <!-- Statistics Cards Grid -->
    <div class="stats-grid">
        <!-- Stat Card 1 -->
        <div class="stat-card">
            <div class="stat-info">
                <h3>Perangkat Desa</h3>
                <div class="stat-value">{{ $apparatusCount }}</div>
            </div>
            <div class="stat-icon icon-blue">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="stat-card">
            <div class="stat-info">
                <h3>Destinasi Wisata</h3>
                <div class="stat-value">{{ $tourismCount }}</div>
            </div>
            <div class="stat-icon icon-purple">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="stat-card">
            <div class="stat-info">
                <h3>Aspirasi Warga</h3>
                <div class="stat-value">{{ $aspirationCount }}</div>
            </div>
            <div class="stat-icon icon-green">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>
    </div>

    <!-- Recent Activity Panel -->
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-comments" style="margin-right: 8px; color: var(--accent-color);"></i> Aspirasi Warga Terbaru</h2>
            <a href="{{ route('admin.aspiration.index') }}" class="btn btn-secondary btn-sm">
                <span>Lihat Semua</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @if($recentAspirations->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-regular fa-comment-dots" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Belum ada aspirasi atau kontak masuk dari warga desa.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Subjek / Topik</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAspirations as $aspiration)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $aspiration->name }}</div>
                                </td>
                                <td>{{ $aspiration->email }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $aspiration->subject }}</span>
                                </td>
                                <td style="color: var(--text-secondary);">
                                    {{ $aspiration->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                </td>
                                <td>
                                    <a href="{{ route('admin.aspiration.index') }}?search={{ urlencode($aspiration->name) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
