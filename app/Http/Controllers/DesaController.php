<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apparatus;
use App\Models\Tourism;
use App\Models\Aspiration;

class DesaController extends Controller
{
    /**
     * Display the village profile homepage with dynamic data.
     */
    public function index()
    {
        // Fetch dynamic data from SQLite database
        $apparatusList = Apparatus::all();
        $tourismList = Tourism::all();

        return view('home', compact('apparatusList', 'tourismList'));
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
            'message' => 'Terima kasih, Bapak/Ibu ' . htmlspecialchars($request->name) . '. Aspirasi Anda telah berhasil terdaftar secara resmi di server Desa Makmur Sentosa!'
        ]);
    }
}
