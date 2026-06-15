<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminBeritaController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Berita::with(['kategori', 'user']);

        if (!empty($search)) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('konten', 'like', '%' . $search . '%');
        }

        $news = $query->latest()->paginate(10)->withQueryString();

        return view('admin.news.index', compact('news', 'search'));
    }

    /**
     * Show the form for creating a new news article.
     */
    public function create()
    {
        $berita = new Berita();
        $this->ensureDefaultCategoryExists();
        $categories = KategoriBerita::all();
        return view('admin.news.form', compact('berita', 'categories'));
    }

    /**
     * Store a newly created news article in storage.
     */
    public function store(Request $request)
    {
        $this->ensureDefaultCategoryExists();
        $validatedData = $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'kategori_id.required' => 'Kategori berita wajib dipilih.',
            'konten.required' => 'Konten berita wajib diisi.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, svg, atau webp.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/news');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $validatedData['gambar'] = 'uploads/news/' . $filename;
        }

        unset($validatedData['foto']);

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = Str::slug($validatedData['judul']) . '-' . rand(1000, 9999);

        Berita::create($validatedData);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita baru berhasil diterbitkan.');
    }

    /**
     * Show the form for editing the specified news article.
     */
    public function edit(Berita $news)
    {
        $berita = $news;
        $this->ensureDefaultCategoryExists();
        $categories = KategoriBerita::all();
        return view('admin.news.form', compact('berita', 'categories'));
    }

    /**
     * Update the specified news article in storage.
     */
    public function update(Request $request, Berita $news)
    {
        $this->ensureDefaultCategoryExists();
        $validatedData = $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'gambar' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|in:draft,published',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'kategori_id.required' => 'Kategori berita wajib dipilih.',
            'konten.required' => 'Konten berita wajib diisi.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, svg, atau webp.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/news');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);

            // Delete old photo if it exists
            if ($news->gambar && Str::startsWith($news->gambar, 'uploads/news/')) {
                $oldPath = public_path($news->gambar);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $validatedData['gambar'] = 'uploads/news/' . $filename;
        }

        unset($validatedData['foto']);

        if ($news->judul !== $validatedData['judul']) {
            $validatedData['slug'] = Str::slug($validatedData['judul']) . '-' . rand(1000, 9999);
        }

        $news->update($validatedData);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified news article from storage.
     */
    public function destroy(Berita $news)
    {
        $title = $news->judul;
        
        // Delete photo from disk if it exists
        if ($news->gambar && Str::startsWith($news->gambar, 'uploads/news/')) {
            $oldPath = public_path($news->gambar);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita "' . $title . '" berhasil dihapus.');
    }

    /**
     * Helper to ensure a default category exists in the database.
     */
    private function ensureDefaultCategoryExists(): void
    {
        if (KategoriBerita::count() === 0) {
            KategoriBerita::create([
                'nama' => 'Umum',
                'slug' => 'umum'
            ]);
        }
    }
}
