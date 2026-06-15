<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSuratController extends Controller
{
    /**
     * Display a listing of citizen letter requests.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $suratQuery = Surat::with(['penduduk', 'jenisSurat', 'operator']);

        if (!empty($search)) {
            $suratQuery->whereHas('penduduk', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%');
            })->orWhere('nomor_surat', 'like', '%' . $search . '%');
        }

        if (!empty($status)) {
            $suratQuery->where('status', $status);
        }

        $suratList = $suratQuery->latest()->paginate(10)->withQueryString();

        return view('admin.surat.index', compact('suratList', 'search', 'status'));
    }

    /**
     * Display detail of a specific letter request.
     */
    public function show($id)
    {
        $surat = Surat::with(['penduduk', 'jenisSurat', 'operator'])->findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    /**
     * Update the status of the letter request (Approve/Reject).
     */
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        
        $request->validate([
            'action' => 'required|in:approve,reject',
            'nomor_surat' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:500',
        ]);

        if ($request->action === 'approve') {
            $surat->update([
                'status' => 'disetujui',
                'tanggal_persetujuan' => now(),
                'tanggal_surat' => now(),
                'operator_id' => Auth::id(),
                'nomor_surat' => $request->nomor_surat ?? $surat->nomor_surat,
                'keterangan' => $request->keterangan ?? $surat->keterangan,
            ]);
            $msg = 'Surat pengajuan berhasil disetujui dan diverifikasi.';
        } else {
            $surat->update([
                'status' => 'ditolak',
                'operator_id' => Auth::id(),
                'keterangan' => $request->keterangan ?? $surat->keterangan,
            ]);
            $msg = 'Surat pengajuan telah ditolak.';
        }

        return redirect()->route('admin.surat.index')->with('success', $msg);
    }

    /**
     * Remove the specified letter request from storage.
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat.index')->with('success', 'Data pengajuan surat berhasil dihapus.');
    }
}
