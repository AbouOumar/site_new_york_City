<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class ProduitsController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        $categories = Categorie::all();
        return view('produit.index', compact('produits', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        Produit::create([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'prix' => $request->prix,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $produit->image;

        if ($request->hasFile('image')) {
            if ($produit->image && file_exists(storage_path('app/public/' . $produit->image))) {
                unlink(storage_path('app/public/' . $produit->image));
            }
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        $produit->update([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'prix' => $request->prix,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        if ($produit->image && file_exists(storage_path('app/public/' . $produit->image))) {
            unlink(storage_path('app/public/' . $produit->image));
        }

        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
