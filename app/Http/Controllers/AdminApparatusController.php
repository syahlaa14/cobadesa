<?php

namespace App\Http\Controllers;

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
            $apparatusQuery->where('name', 'like', '%' . $search . '%')
                           ->orWhere('role', 'like', '%' . $search . '%')
                           ->orWhere('desc', 'like', '%' . $search . '%');
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
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'icon' => 'required|string|max:100',
            'desc' => 'required|string|max:500',
            'facebook' => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'email' => 'nullable|email|max:150',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'role.required' => 'Jabatan (Role) wajib diisi.',
            'icon.required' => 'Ikon FontAwesome wajib diisi (misal: fa-user).',
            'desc.required' => 'Deskripsi singkat tugas wajib diisi.',
            'facebook.url' => 'Format URL Facebook tidak valid.',
            'instagram.url' => 'Format URL Instagram tidak valid.',
            'email.email' => 'Format email tidak valid.',
        ]);

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
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'icon' => 'required|string|max:100',
            'desc' => 'required|string|max:500',
            'facebook' => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'email' => 'nullable|email|max:150',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'role.required' => 'Jabatan (Role) wajib diisi.',
            'icon.required' => 'Ikon FontAwesome wajib diisi.',
            'desc.required' => 'Deskripsi singkat tugas wajib diisi.',
            'facebook.url' => 'Format URL Facebook tidak valid.',
            'instagram.url' => 'Format URL Instagram tidak valid.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $apparatus->update($validatedData);

        return redirect()->route('admin.apparatus.index')
            ->with('success', 'Data aparatur ' . $apparatus->name . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified apparatus from storage.
     */
    public function destroy(Apparatus $apparatus)
    {
        $name = $apparatus->name;
        $apparatus->delete();

        return redirect()->route('admin.apparatus.index')
            ->with('success', 'Data aparatur ' . $name . ' berhasil dihapus.');
    }
}
