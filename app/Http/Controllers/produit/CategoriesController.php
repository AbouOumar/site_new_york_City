<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategoriesController extends Controller
{
    // Affichage de toutes les catégories
    public function index()
    {
        $categories = Categorie::all();
        return view('categorie.index', compact('categories'));
    }

    // Création d'une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categorie::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    // Mise à jour d'une catégorie existante
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categorie->update([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Suppression d'une catégorie
    public function delete(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}

