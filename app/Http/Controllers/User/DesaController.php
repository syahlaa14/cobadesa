<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apparatus;
use App\Models\Tourism;
use App\Models\Aspiration;
use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\Surat;
use App\Models\Berita;
use App\Models\Kegiatan;

class DesaController extends Controller
{
    /**
     * Display the village profile homepage with dynamic data.
     */
    public function index()
    {
        // Fetch dynamic data
        $apparatusList = Apparatus::all();
        $tourismList = Tourism::all();
        $newsList = Berita::with('kategori')->where('status', 'published')->latest()->get();
        $eventsList = Kegiatan::latest()->get();

        return view('home', compact('apparatusList', 'tourismList', 'newsList', 'eventsList'));
    }

    /**
     * Handle the AJAX post submission of village aspirations with validation.
     */
    public function submitAspirasi(Request $request)
    {
        // Server-side validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan atau aspirasi wajib diisi.',
            'message.min' => 'Pesan terlalu pendek, minimal 10 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Save the aspiration dynamically to the database
        Aspiration::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Terima kasih, Bapak/Ibu ' . htmlspecialchars($request->name) . '. Aspirasi Anda telah berhasil terdaftar secara resmi di Desa Pasir Kulon!'
        ]);
    }

    /**
     * Handle E-Surat online draft submission and save to MySQL database.
     */
    public function submitSurat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'nik' => 'required|string|size:16',
            'address' => 'required|string|max:250',
            'detail' => 'required|string|max:250',
            'type' => 'required|string|in:sku,sktm,sp',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus tepat 16 digit.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'detail.required' => 'Detail/Keterangan surat wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // 1. Dapatkan atau buat data Penduduk berdasarkan NIK
        $penduduk = Penduduk::where('nik', $request->nik)->first();
        if (!$penduduk) {
            $penduduk = Penduduk::create([
                'nik' => $request->nik,
                'nama_lengkap' => $request->name,
                'alamat' => $request->address,
                'tempat_lahir' => 'Pasir Kulon',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan' => 'Pelajar/Mahasiswa',
                'pendidikan' => 'SMA',
                'rt' => '01',
                'rw' => '01',
            ]);
        }

        // 2. Dapatkan atau buat Jenis Surat
        $jenisSuratMapping = [
            'sku' => [
                'nama' => 'Surat Keterangan Usaha',
                'prefix' => '503',
            ],
            'sktm' => [
                'nama' => 'Surat Keterangan Tidak Mampu',
                'prefix' => '401',
            ],
            'sp' => [
                'nama' => 'Surat Pengantar Umum',
                'prefix' => '140',
            ],
        ];

        $mapping = $jenisSuratMapping[$request->type];

        $jenisSurat = JenisSurat::where('kode_surat', $request->type)->first();
        if (!$jenisSurat) {
            $jenisSurat = JenisSurat::create([
                'nama_surat' => $mapping['nama'],
                'kode_surat' => $request->type,
                'keterangan' => 'Layanan pengajuan draf surat mandiri online',
                'aktif' => true,
            ]);
        }

        // 3. Generate Nomor Surat secara acak & simpan
        $randNum = rand(100, 299);
        $nomorSurat = $mapping['prefix'] . ' / ' . $randNum . ' / VIII / 2026';

        $surat = Surat::create([
            'penduduk_id' => $penduduk->id,
            'jenis_surat_id' => $jenisSurat->id,
            'nomor_surat' => $nomorSurat,
            'status' => 'pending',
            'keterangan' => $request->detail,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Draf surat ' . $mapping['nama'] . ' berhasil didaftarkan!',
            'data' => [
                'nomor_surat' => $nomorSurat,
                'name' => $penduduk->nama_lengkap,
                'nama' => $penduduk->nama_lengkap,
                'nik' => $penduduk->nik,
                'alamat' => $penduduk->alamat,
                'keterangan' => $surat->keterangan,
            ]
        ]);
    }
}
