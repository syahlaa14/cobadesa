<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKegiatanController extends Controller
{
    /**
     * Display a listing of the events/activities.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Kegiatan::query();

        if (!empty($search)) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');
        }

        $events = $query->latest()->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events', 'search'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $event = new Kegiatan();
        return view('admin.events.form', compact('event'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:200',
            'status' => 'required|in:rencana,berjalan,selesai',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['judul']) . '-' . rand(1000, 9999);

        Kegiatan::create($validatedData);

        return redirect()->route('admin.events.index')
            ->with('success', 'Kegiatan/Event baru berhasil didaftarkan.');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Kegiatan $event)
    {
        return view('admin.events.form', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Kegiatan $event)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:200',
            'status' => 'required|in:rencana,berjalan,selesai',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
        ]);

        if ($event->judul !== $validatedData['judul']) {
            $validatedData['slug'] = Str::slug($validatedData['judul']) . '-' . rand(1000, 9999);
        }

        $event->update($validatedData);

        return redirect()->route('admin.events.index')
            ->with('success', 'Kegiatan/Event berhasil diperbarui.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Kegiatan $event)
    {
        $title = $event->judul;
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Kegiatan "' . $title . '" berhasil dihapus.');
    }
}
