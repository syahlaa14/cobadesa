<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apparatus;
use App\Models\Aspiration;
use App\Models\Surat;
use App\Models\Penduduk;

class AdminDashboardController extends Controller
{
    /**
     * Display the main admin dashboard page.
     */
    public function index()
    {
        $apparatusCount = Apparatus::count();
        $aspirationCount = Aspiration::count();
        $suratCount = Surat::count();
        $baseSeededCount = 10;
        $currentCount = Penduduk::count();
        $pendudukCount = 4320 + max(0, $currentCount - $baseSeededCount);

        // Get 5 latest citizen aspirations
        $recentAspirations = Aspiration::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'apparatusCount',
            'aspirationCount',
            'suratCount',
            'pendudukCount',
            'recentAspirations'
        ));
    }
}
