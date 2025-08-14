<?php

namespace App\Http\Controllers\entite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entite;
use App\Models\SubEntite;
use App\Models\Hotel;

class SubEntitesController extends Controller
{
     public function index()
    {
        $subEntites = SubEntite::with('entite')->get();
        $entites = Entite::all();
        $hotels = Hotel::all();
        return view('subentite.index', compact('entites', 'subEntites', 'hotels'));
    }

    public function create(Entite $entite)
    {
        return view('subentite.create', compact('entite'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'nullable|numeric',
            'forfait' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'nombre_place' => 'nullable|integer',
            'emplacement' => 'nullable|string|max:255',
        ]);

        SubEntite::create([
            'entite_id' => $request->entite_id,
            'nom' => $request->nom,
            'description' => $request->description,
            'forfait' => $request->forfait,
            'nombre_place' => $request->nombre_place,
            'emplacement' => $request->emplacement,
            'prix' => $request->prix,
        ]);

        return redirect()->route('subentites.index')
                         ->with('success', 'Sous-entite ajouté avec succès.');
    }

    public function edit(Entite $entite, SubEntite $subEntite)
    {
        return view('subentite.edit', compact('entite', 'subEntite'));
    }

    public function update(Request $request, SubEntite $subEntite)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'nullable|numeric',
            'forfait' => 'nullable|string|max:255',
            'nombre_place' => 'nullable|integer',
            'emplacement' => 'nullable|string|max:255',
        ]);

        $subEntite->update($request->only('nom', 'prix', 'forfait', 'nombre_place', 'emplacement'));

        return redirect()->route('subentites.index')
                         ->with('success', 'Sous-entité mise à jour avec succès.');
    }

    public function destroy(SubEntite $subEntite)
    {
        $subEntite->delete();

        return redirect()->route('subentites.index')
                         ->with('success', 'Sous-entité supprimée avec succès.');
    }
    //
}
