<?php

namespace App\Http\Controllers\entite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entite;
use App\Models\SubEntite;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;

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
            'entite_id' => 'required|exists:entites,id',
            'image' => 'nullable|image|max:2048', // validation image
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subentites', 'public');
        }

        SubEntite::create([
            'entite_id' => $request->entite_id,
            'nom' => $request->nom,
            'description' => $request->description,
            'forfait' => $request->forfait,
            'nombre_place' => $request->nombre_place,
            'emplacement' => $request->emplacement,
            'prix' => $request->prix,
            'image' => $imagePath,
        ]);

        return redirect()->route('subentites.index')->with('success', 'Sous-entité ajoutée avec succès.');
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
            'entite_id' => 'required|exists:entites,id',
            'image' => 'nullable|image|max:2048', // validation image
        ]);

        $data = $request->only('nom', 'prix', 'forfait', 'nombre_place', 'emplacement', 'entite_id', 'description');

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($subEntite->image && Storage::disk('public')->exists($subEntite->image)) {
                Storage::disk('public')->delete($subEntite->image);
            }
            $data['image'] = $request->file('image')->store('subentites', 'public');
        }

        $subEntite->update($data);

        return redirect()->route('subentites.index')
                         ->with('success', 'Sous-entité mise à jour avec succès.');
    }

    public function destroy(SubEntite $subEntite)
    {
        // Supprimer l'image associée si elle existe
        if ($subEntite->image && Storage::disk('public')->exists($subEntite->image)) {
            Storage::disk('public')->delete($subEntite->image);
        }

        $subEntite->delete();

        return redirect()->route('subentites.index')
                         ->with('success', 'Sous-entité supprimée avec succès.');
    }
}
