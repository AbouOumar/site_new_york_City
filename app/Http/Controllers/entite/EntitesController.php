<?php

namespace App\Http\Controllers\entite;

use App\Models\Entite;
use App\Models\Hotel;
use App\Models\SubEntite; // Assurez-vous que ce modèle existe
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntitesController extends Controller
{
    public function index()
    {
        $entites = Entite::with('hotel')->get(); // Charger l'hôtel lié
        $hotels = Hotel::all(); // Pour le formulaire de création/modification
        return view('entite.index', compact('entites', 'hotels'));
    }

    public function getEntitesByHotel($hotelId)
{
    $entites = Entite::where('hotel_id', $hotelId)->get(['id', 'nom']);
    return response()->json($entites);
}

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:entites,nom',
            'description' => 'nullable|string',
            'hotel_id' => 'required|exists:hotels,id',
            'type' => 'required|in:Restaurant,Boites,Plein air,Piscine,Chambres',
        ]);

        Entite::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'hotel_id' => $request->hotel_id,
            'type' => $request->type,
        ]);

        return redirect()->route('entites.index')->with('success', 'Entité ajoutée avec succès.');
    }

    public function update(Request $request, Entite $entite)
    {
        $request->validate([
            'nom' => 'required|string|unique:entites,nom,' . $entite->id,
            'description' => 'nullable|string',
            'hotel_id' => 'required|exists:hotels,id',
            'type' => 'required|in:Restaurant,Boites,Plein air,Piscine,Chambres',
        ]);

        $entite->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'hotel_id' => $request->hotel_id,
            'type' => $request->type,
        ]);

        return redirect()->route('entites.index')->with('success', 'Entité modifiée avec succès.');
    }

    public function destroy(Entite $entite)
    {
        $entite->delete();
        return redirect()->route('entites.index')->with('success', 'Entité supprimée avec succès.');
    }

    public function show($id)
    {
        // On récupère l'entité avec ses sous-entités
        $entite = Entite::with('subEntites')->findOrFail($id);

        // On récupère la liste de tous les services (ou liés à l'entité si nécessaire)
        $subEntites = SubEntite::all();

        return view('entite.detail', [
            'entite' => $entite,
            'subEntites' => $subEntites
        ]);
    }

}
