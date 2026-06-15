<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apparatus;
use Illuminate\Http\Request;

class AdminApparatusController extends Controller
{
    /**
     * Display a listing of the apparatus.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $apparatusQuery = Apparatus::query();

        if (!empty($search)) {
            $apparatusQuery->where('nama', 'like', '%' . $search . '%')
                           ->orWhere('jabatan', 'like', '%' . $search . '%')
                           ->orWhere('keterangan_jabatan', 'like', '%' . $search . '%');
        }

        $apparatuses = $apparatusQuery->latest()->paginate(10)->withQueryString();

        return view('admin.apparatus.index', compact('apparatuses', 'search'));
    }

    /**
     * Show the form for creating a new apparatus.
     */
    public function create()
    {
        $apparatus = new Apparatus();
        return view('admin.apparatus.form', compact('apparatus'));
    }

    /**
     * Store a newly created apparatus in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|string|max:255',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan_jabatan' => 'required|string|max:500',
            'facebook' => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'email' => 'nullable|email|max:150',
            'nip' => 'nullable|string|max:50',
            'sk_pengangkatan' => 'nullable|string|max:100',
            'tanggal_sk' => 'nullable|date',
            'status_aktif' => 'nullable|boolean',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'keterangan_jabatan.required' => 'Deskripsi singkat tugas wajib diisi.',
            'facebook.url' => 'Format URL Facebook tidak valid.',
            'instagram.url' => 'Format URL Instagram tidak valid.',
            'email.email' => 'Format email tidak valid.',
            'foto_file.image' => 'Berkas harus berupa gambar.',
            'foto_file.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_file.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/apparatus');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $validatedData['foto'] = 'uploads/apparatus/' . $filename;
        }

        unset($validatedData['foto_file']);

        if (!isset($validatedData['status_aktif'])) {
            $validatedData['status_aktif'] = true;
        }

        Apparatus::create($validatedData);

        return redirect()->route('admin.apparatus.index')
            ->with('success', 'Data aparatur baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified apparatus.
     */
    public function edit(Apparatus $apparatus)
    {
        return view('admin.apparatus.form', compact('apparatus'));
    }

    /**
     * Update the specified apparatus in storage.
     */
    public function update(Request $request, Apparatus $apparatus)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'foto' => 'nullable|string|max:255',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'keterangan_jabatan' => 'required|string|max:500',
            'facebook' => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'email' => 'nullable|email|max:150',
            'nip' => 'nullable|string|max:50',
            'sk_pengangkatan' => 'nullable|string|max:100',
            'tanggal_sk' => 'nullable|date',
            'status_aktif' => 'nullable|boolean',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'keterangan_jabatan.required' => 'Deskripsi singkat tugas wajib diisi.',
            'facebook.url' => 'Format URL Facebook tidak valid.',
            'instagram.url' => 'Format URL Instagram tidak valid.',
            'email.email' => 'Format email tidak valid.',
            'foto_file.image' => 'Berkas harus berupa gambar.',
            'foto_file.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_file.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/apparatus');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);

            // Delete old photo
            if ($apparatus->foto && \Illuminate\Support\Str::startsWith($apparatus->foto, 'uploads/apparatus/')) {
                $oldPath = public_path($apparatus->foto);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $validatedData['foto'] = 'uploads/apparatus/' . $filename;
        }

        unset($validatedData['foto_file']);

        $validatedData['status_aktif'] = $request->has('status_aktif');

        $apparatus->update($validatedData);

        return redirect()->route('admin.apparatus.index')
            ->with('success', 'Data aparatur ' . $apparatus->nama . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified apparatus from storage.
     */
    public function destroy(Apparatus $apparatus)
    {
        $name = $apparatus->nama;

        // Delete photo from disk if it exists
        if ($apparatus->foto && \Illuminate\Support\Str::startsWith($apparatus->foto, 'uploads/apparatus/')) {
            $oldPath = public_path($apparatus->foto);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $apparatus->delete();

        return redirect()->route('admin.apparatus.index')
            ->with('success', 'Data aparatur ' . $name . ' berhasil dihapus.');
    }
}
