@extends('layouts.admin')

@section('title', 'Kelola Aspirasi Warga')
@section('page_heading', 'Aspirasi & Kontak Warga')
@section('page_subheading', 'Melihat saran, aspirasi, keluhan, dan pesan langsung dari warga Desa Makmur Sentosa.')

@section('content')
    <div class="panel-card">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fa-solid fa-comments" style="margin-right: 8px; color: var(--accent-color);"></i> Daftar Aspirasi Masuk</h2>
        </div>

        <!-- Search Filter -->
        <form action="{{ route('admin.aspiration.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="form-control search-input" 
                placeholder="Cari pengirim, email, pesan..." 
                value="{{ $search ?? '' }}"
            >
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(!empty($search))
                <a href="{{ route('admin.aspiration.index') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>

        @if($aspirations->isEmpty())
            <div style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
                <i class="fa-regular fa-envelope" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
                <p>Tidak ada pesan aspirasi warga yang cocok dengan pencarian.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Subjek / Topik</th>
                            <th>Pesan Singkat</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aspirations as $aspiration)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; font-size: 1rem;">{{ $aspiration->name }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-secondary);">{{ $aspiration->email }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $aspiration->subject }}</span>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem; max-width: 350px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: var(--text-secondary);">
                                        {{ $aspiration->message }}
                                    </div>
                                </td>
                                <td style="color: var(--text-secondary);">
                                    {{ $aspiration->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button 
                                            type="button" 
                                            class="btn btn-primary btn-sm btn-view-aspiration" 
                                            data-name="{{ $aspiration->name }}"
                                            data-email="{{ $aspiration->email }}"
                                            data-subject="{{ $aspiration->subject }}"
                                            data-message="{{ $aspiration->message }}"
                                            data-date="{{ $aspiration->created_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB"
                                            title="Baca Detail Aspirasi"
                                        >
                                            <i class="fa-solid fa-envelope-open"></i> Baca
                                        </button>
                                        <form action="{{ route('admin.aspiration.destroy', $aspiration->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi dari {{ $aspiration->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Aspirasi">
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
                {{ $aspirations->links() }}
            </div>
        @endif
    </div>

    <!-- Interactive Detail Modal -->
    <div class="detail-modal" id="aspirationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="panel-title" id="modalSubject">Subjek Aspirasi</h3>
                <button type="button" class="btn btn-secondary btn-sm" id="modalCloseX" style="padding: 4px 8px; border-radius: 50%;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-meta">
                    <p><strong>Pengirim:</strong> <span id="modalSender">Nama Pengirim</span> (<span id="modalEmail">email@domain.com</span>)</p>
                    <p><strong>Diterima:</strong> <span id="modalDate">Tanggal Masuk</span></p>
                </div>
                <div style="background-color: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; font-size: 0.95rem; color: var(--text-primary); white-space: pre-line; max-height: 350px; overflow-y: auto;" id="modalMessage">
                    Pesan Lengkap...
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border-color);">
                <button type="button" class="btn btn-secondary" id="modalCloseBtn">Tutup</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('aspirationModal');
            const viewButtons = document.querySelectorAll('.btn-view-aspiration');
            const closeX = document.getElementById('modalCloseX');
            const closeBtn = document.getElementById('modalCloseBtn');

            // Elements to populate
            const modalSubject = document.getElementById('modalSubject');
            const modalSender = document.getElementById('modalSender');
            const modalEmail = document.getElementById('modalEmail');
            const modalDate = document.getElementById('modalDate');
            const modalMessage = document.getElementById('modalMessage');

            function openModal(data) {
                modalSubject.textContent = data.subject;
                modalSender.textContent = data.name;
                modalEmail.textContent = data.email;
                modalDate.textContent = data.date;
                modalMessage.textContent = data.message;
                
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
            }

            viewButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const data = {
                        name: this.getAttribute('data-name'),
                        email: this.getAttribute('data-email'),
                        subject: this.getAttribute('data-subject'),
                        message: this.getAttribute('data-message'),
                        date: this.getAttribute('data-date')
                    };
                    openModal(data);
                });
            });

            closeX.addEventListener('click', closeModal);
            closeBtn.addEventListener('click', closeModal);

            // Close modal when clicking on the backdrop
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
