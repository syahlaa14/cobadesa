@extends('layouts.admin')

@section('title', 'Detail Pengajuan Surat')
@section('page_heading', 'Detail Pengajuan')
@section('page_subheading', 'Verifikasi berkas pemohon dan ubah status draf surat.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 380px; gap: 24px; align-items: start;">
    
    <!-- Virtual Letter Preview -->
    <div class="panel-card" style="padding: 30px;">
        <h3 style="margin-bottom: 20px; font-weight: 700; color: var(--accent-color); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
            <i class="fa-solid fa-file-invoice"></i> Pratinjau Draf Surat
        </h3>

        <!-- Virtual Letterhead -->
        <div style="border: 1px solid var(--border-color); border-radius: 8px; padding: 30px; background: #fff; color: #000; font-family: 'Times New Roman', Times, serif; line-height: 1.5; font-size: 14px;">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px; text-align: center;">
                <i class="fa-solid fa-mountain-sun" style="font-size: 40px; color: #000;"></i>
                <div style="flex-grow: 1;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: bold; text-transform: uppercase;">Pemerintah Kabupaten Jaya Raya</h4>
                    <h5 style="margin: 2px 0; font-size: 13px; font-weight: bold; text-transform: uppercase;">Kecamatan Harapan Indah</h5>
                    <h3 style="margin: 2px 0; font-size: 17px; font-weight: 900; text-transform: uppercase;">Kantor Kepala Desa Pasir Kulon</h3>
                    <p style="font-size: 11px; margin: 0;">Jl. Raya Puncak No. 12, Kode Pos 40391 | Email: desa@pasirkulon.sch.id</p>
                </div>
            </div>
            
            <hr style="border: none; border-top: 3px double #000; margin: 10px 0 20px;">
            
            <div style="text-align: center; margin-bottom: 24px;">
                <h4 style="font-size: 16px; font-weight: bold; text-decoration: underline; margin: 0 0 4px; text-transform: uppercase;">{{ $surat->jenisSurat->nama_surat }}</h4>
                <p style="font-size: 13px; margin: 0;">Nomor: {{ $surat->nomor_surat }}</p>
            </div>
            
            <div style="text-align: justify; font-size: 13px;">
                <p style="text-indent: 30px; margin-bottom: 14px;">Yang bertanda tangan di bawah ini, Kepala Desa Pasir Kulon, Kecamatan Harapan Indah, Kabupaten Jaya Raya, dengan ini menerangkan bahwa:</p>
                
                <table style="width: 100%; margin: 15px 0 20px 30px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 30%; padding: 4px 0;">Nama Lengkap</td>
                        <td style="width: 5%; padding: 4px 0;">:</td>
                        <td style="font-weight: bold; padding: 4px 0;">{{ $surat->penduduk->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0;">NIK</td>
                        <td style="padding: 4px 0;">:</td>
                        <td style="padding: 4px 0;">{{ $surat->penduduk->nik }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0;">Alamat</td>
                        <td style="padding: 4px 0;">:</td>
                        <td style="padding: 4px 0;">{{ $surat->penduduk->alamat }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0;">
                            @if($surat->jenisSurat->kode_surat === 'sku')
                                Detail Usaha
                            @elseif($surat->jenisSurat->kode_surat === 'sktm')
                                Tujuan Pengajuan
                            @else
                                Tujuan Surat
                            @endif
                        </td>
                        <td style="padding: 4px 0;">:</td>
                        <td style="padding: 4px 0; font-style: italic;">{{ $surat->keterangan }}</td>
                    </tr>
                </table>
                
                <p style="text-indent: 30px; margin-bottom: 14px;">
                    @if($surat->jenisSurat->kode_surat === 'sku')
                        Benar bahwa nama di atas memiliki usaha yang terdaftar di Desa Pasir Kulon dan dalam keadaan aktif. Surat Keterangan ini dibuat untuk memenuhi administrasi persyaratan pengajuan pinjaman modal usaha.
                    @elseif($surat->jenisSurat->kode_surat === 'sktm')
                        Benar bahwa nama di atas adalah warga asli Desa Pasir Kulon yang tergolong dalam keluarga ekonomi rentan/kurang mampu. Surat Keterangan ini dibuat sebagai lampiran persyaratan pengajuan bantuan sosial.
                    @else
                        Benar bahwa nama di atas adalah penduduk yang berdomisili sah di Desa Pasir Kulon. Surat Keterangan Pengantar ini dibuat untuk memperlancar administrasi pengurusan dokumen kependudukan tingkat Kecamatan.
                    @endif
                </p>
                <p style="text-indent: 30px; margin-bottom: 14px;">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>
            
            <div style="float: right; width: 220px; text-align: center; margin-top: 30px; font-size: 13px;">
                <p>Pasir Kulon, {{ $surat->tanggal_surat ? $surat->tanggal_surat->format('d F Y') : date('d F Y') }}</p>
                <p style="font-weight: bold; margin-top: 5px; margin-bottom: 60px;">Kepala Desa Pasir Kulon</p>
                
                @if($surat->status === 'disetujui')
                    <div style="position: relative; height: 10px;">
                        <span style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%) rotate(-12deg); border: 2px dashed #dc2626; border-radius: 4px; color: #dc2626; padding: 4px 12px; font-size: 11px; font-weight: bold; background: rgba(220, 38, 38, 0.05); text-transform: uppercase;">
                            PEMDES VALID
                        </span>
                    </div>
                @endif
                
                <p style="font-weight: bold; text-decoration: underline;">Ir. H. Budi Santoso</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <!-- Actions Panel -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <!-- Status Box -->
        <div class="panel-card" style="padding: 24px;">
            <h4 style="margin-bottom: 16px; font-weight: 700;">Status Saat Ini</h4>
            <div style="margin-bottom: 16px;">
                @if($surat->status === 'pending')
                    <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 20px; background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); font-weight: 600;">
                        <i class="fa-solid fa-clock-rotate-left"></i> Menunggu Verifikasi
                    </div>
                @elseif($surat->status === 'disetujui')
                    <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 20px; background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-weight: 600;">
                        <i class="fa-solid fa-circle-check"></i> Telah Disetujui
                    </div>
                    <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 10px;">
                        Disetujui oleh: <strong>{{ $surat->operator->name ?? 'Admin' }}</strong><br>
                        Tanggal: {{ $surat->tanggal_persetujuan->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </div>
                @else
                    <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 20px; background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); font-weight: 600;">
                        <i class="fa-solid fa-circle-xmark"></i> Telah Ditolak
                    </div>
                    <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 10px;">
                        Ditolak oleh: <strong>{{ $surat->operator->name ?? 'Admin' }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Form -->
        <div class="panel-card" style="padding: 24px;">
            <h4 style="margin-bottom: 16px; font-weight: 700;">Tindakan Verifikasi</h4>
            
            <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nomor_surat" class="form-label">Sesuaikan Nomor Surat</label>
                    <input 
                        type="text" 
                        name="nomor_surat" 
                        id="nomor_surat" 
                        class="form-control" 
                        value="{{ $surat->nomor_surat }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="keterangan" class="form-label">Detail / Catatan Tambahan</label>
                    <textarea 
                        name="keterangan" 
                        id="keterangan" 
                        rows="3" 
                        class="form-control" 
                        placeholder="Tambahkan keterangan/koreksi detail isi surat jika diperlukan..."
                    >{{ $surat->keterangan }}</textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 20px;">
                    <button type="submit" name="action" value="approve" class="btn btn-primary" style="background: linear-gradient(135deg, #059669, #10b981); border: none; width: 100%; justify-content: center;">
                        <i class="fa-solid fa-circle-check"></i> Setujui & Sahkan Surat
                    </button>
                    
                    <button type="submit" name="action" value="reject" class="btn btn-danger" style="background: linear-gradient(135deg, #dc2626, #ef4444); border: none; width: 100%; justify-content: center;">
                        <i class="fa-solid fa-circle-xmark"></i> Tolak Pengajuan
                    </button>
                    
                    <a href="{{ route('admin.surat.index') }}" class="btn btn-secondary" style="width: 100%; justify-content: center;">
                        Kembali Ke Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
