<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Utilisateur;
use App\Models\Entite;
use App\Models\SubEntite;
use App\Models\Vente;

class SuperAdminDashboardController extends Controller
{
     public function index()
    {
        return view('dashboard.superadmin', [
            'hotelsCount'   => Hotel::count(),
            'utilisateursCount'    => Utilisateur::count(),
            'entitesCount'   => Entite::count(),
            'subEntitesCount'   => SubEntite::count(),
            // Regroupement des entités par hôtel
            'entitesParHotel' => Entite::select('hotel_id')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('hotel_id')
                ->with('hotel')
                ->get()
                ->map(function($item) {
                    return [
                        'hotel_nom' => $item->hotel ? $item->hotel->nom : 'Inconnu',
                        'count' => $item->count
                    ];
                }),
            'hotelsParVille'  => Hotel::select('location')
                                     ->selectRaw('COUNT(*) as count')
                                     ->groupBy('location')
                                     ->pluck('count', 'location'),
            'utilisateursRecent'   => Utilisateur::latest()->take(5)->get(),
            'hotelsRecent'  => Hotel::latest()->take(5)->get(),
            'ventesRecent'  => Vente::latest()->take(5)->get(),
        ]);
    }
    //
}
