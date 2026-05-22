@extends('layouts.admin')

@section('title', 'Detail Aspirasi Warga')
@section('page_heading', 'Detail Aspirasi')
@section('page_subheading', 'Melihat detail isi pesan dari warga.')

@section('content')
    <div class="panel-card" style="max-width: 800px; margin: 0 auto;">
        <div class="panel-header" style="border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h2 class="panel-title">
                <i class="fa-solid fa-envelope-open-text" style="margin-right: 8px; color: var(--accent-color);"></i>
                Subjek: {{ $aspiration->subject }}
            </h2>
            <a href="{{ route('admin.aspiration.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div style="margin-bottom: 24px; font-size: 0.95rem; line-height: 1.8;">
            <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                <p style="margin-bottom: 8px;"><strong>Nama Pengirim:</strong> {{ $aspiration->name }}</p>
                <p style="margin-bottom: 8px;"><strong>Email:</strong> <a href="mailto:{{ $aspiration->email }}" style="color: var(--accent-color); text-decoration: underline;">{{ $aspiration->email }}</a></p>
                <p style="margin-bottom: 8px;"><strong>Diterima Pada:</strong> {{ $aspiration->created_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB</p>
            </div>

            <div style="background-color: rgba(15, 23, 42, 0.5); border: 1px solid var(--border-color); border-radius: 8px; padding: 24px; white-space: pre-line;">
                {{ $aspiration->message }}
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid var(--border-color); padding-top: 20px;">
            <form action="{{ route('admin.aspiration.destroy', $aspiration->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can"></i> Hapus Aspirasi
                </button>
            </form>
        </div>
    </div>
@endsection
