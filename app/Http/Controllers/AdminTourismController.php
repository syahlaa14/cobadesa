<?php

namespace App\Http\Controllers;

use App\Models\Tourism;
use Illuminate\Http\Request;

class AdminTourismController extends Controller
{
    /**
     * Display a listing of the tourism items.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $tourismQuery = Tourism::query();

        if (!empty($search)) {
            $tourismQuery->where('title', 'like', '%' . $search . '%')
                         ->orWhere('category', 'like', '%' . $search . '%')
                         ->orWhere('category_label', 'like', '%' . $search . '%')
                         ->orWhere('desc', 'like', '%' . $search . '%');
        }

        $tourisms = $tourismQuery->latest()->paginate(10)->withQueryString();

        return view('admin.tourism.index', compact('tourisms', 'search'));
    }

    /**
     * Show the form for creating a new tourism item.
     */
    public function create()
    {
        $tourism = new Tourism();
        return view('admin.tourism.form', compact('tourism'));
    }

    /**
     * Store a newly created tourism item in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'category_label' => 'required|string|max:50',
            'icon' => 'required|string|max:50',
            'desc' => 'required|string|max:1000',
        ], [
            'title.required' => 'Judul destinasi wisata wajib diisi.',
            'category.required' => 'Kategori (slug) wajib diisi (misal: wisata-alam).',
            'category_label.required' => 'Label kategori wajib diisi (misal: Wisata Alam).',
            'icon.required' => 'Ikon FontAwesome wajib diisi (misal: fa-tree).',
            'desc.required' => 'Deskripsi destinasi wisata wajib diisi.',
        ]);

        Tourism::create($validatedData);

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Destinasi wisata baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified tourism item.
     */
    public function edit(Tourism $tourism)
    {
        return view('admin.tourism.form', compact('tourism'));
    }

    /**
     * Update the specified tourism item in storage.
     */
    public function update(Request $request, Tourism $tourism)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'category_label' => 'required|string|max:50',
            'icon' => 'required|string|max:50',
            'desc' => 'required|string|max:1000',
        ], [
            'title.required' => 'Judul destinasi wisata wajib diisi.',
            'category.required' => 'Kategori (slug) wajib diisi.',
            'category_label.required' => 'Label kategori wajib diisi.',
            'icon.required' => 'Ikon FontAwesome wajib diisi.',
            'desc.required' => 'Deskripsi destinasi wisata wajib diisi.',
        ]);

        $tourism->update($validatedData);

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Destinasi wisata ' . $tourism->title . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified tourism item from storage.
     */
    public function destroy(Tourism $tourism)
    {
        $title = $tourism->title;
        $tourism->delete();

        return redirect()->route('admin.tourism.index')
            ->with('success', 'Destinasi wisata ' . $title . ' berhasil dihapus.');
    }
}
