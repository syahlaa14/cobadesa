<?php

namespace App\Http\Controllers;

use App\Models\Apparatus;
use App\Models\Tourism;
use App\Models\Aspiration;

class AdminDashboardController extends Controller
{
    /**
     * Display the main admin dashboard page.
     */
    public function index()
    {
        $apparatusCount = Apparatus::count();
        $tourismCount = Tourism::count();
        $aspirationCount = Aspiration::count();

        // Get 5 latest citizen aspirations
        $recentAspirations = Aspiration::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'apparatusCount',
            'tourismCount',
            'aspirationCount',
            'recentAspirations'
        ));
    }
}
