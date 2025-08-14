<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Utilisateur;

class SuperAdminDashboardController extends Controller
{
     public function index()
    {
        return view('dashboard.superadmin', [
            'hotelsCount'   => Hotel::count(),
            'utilisateursCount'    => Utilisateur::count(),
            'hotelsParVille'  => Hotel::select('location')
                                     ->selectRaw('COUNT(*) as count')
                                     ->groupBy('location')
                                     ->pluck('count', 'location'),
            'utilisateursRecent'   => Utilisateur::latest()->take(5)->get(),
            'hotelsRecent'  => Hotel::latest()->take(5)->get(),
        ]);
    }
    //
}
