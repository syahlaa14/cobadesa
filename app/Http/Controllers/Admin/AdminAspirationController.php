<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AdminAspirationController extends Controller
{
    /**
     * Display a listing of aspirations.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $aspirationQuery = Aspiration::query();

        if (!empty($search)) {
            $aspirationQuery->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%')
                             ->orWhere('subject', 'like', '%' . $search . '%')
                             ->orWhere('message', 'like', '%' . $search . '%');
        }

        $aspirations = $aspirationQuery->latest()->paginate(10)->withQueryString();

        return view('admin.aspiration.index', compact('aspirations', 'search'));
    }

    /**
     * Display the specified aspiration.
     */
    public function show(Aspiration $aspiration)
    {
        return view('admin.aspiration.show', compact('aspiration'));
    }

    /**
     * Remove the specified aspiration from storage.
     */
    public function destroy(Aspiration $aspiration)
    {
        $name = $aspiration->name;
        $aspiration->delete();

        return redirect()->route('admin.aspiration.index')
            ->with('success', 'Aspirasi dari ' . $name . ' berhasil dihapus.');
    }
}
