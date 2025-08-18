<?php

namespace App\Http\Controllers\vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubEntite;
use App\Models\Categorie;

class ventesController extends Controller
{
     public function create()
    {
        $subEntites = SubEntite::all();
        $categories = Categorie::with('produits')->get(); // Produits par catégorie
        return view('venteDirect.index', compact('subEntites', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'entite_id' => 'required|exists:entites,id',
            'situation' => 'required|in:soldé,crédit',
            'remiseGlobale' => 'nullable|numeric|min:0',
            'netAPayer' => 'required|numeric|min:0',
            'detail' => 'required|array|min:1',
            'detail.*.produit_id' => 'required|exists:produits,id',
            'detail.*.quantite' => 'required|integer|min:1',
            'detail.*.prix' => 'required|numeric|min:0',
            'detail.*.remise' => 'nullable|numeric|min:0',
            'detail.*.net' => 'required|numeric|min:0',
        ]);

        $vente = Vente::create([
            'entite_id' => $data['entite_id'],
            'status' => $data['situation'],
            'remise_globale' => $data['remiseGlobale'],
            'net' => $data['netAPayer'],
        ]);

        foreach ($data['detail'] as $detail) {
            $vente->details()->create($detail);
        }

        return redirect()->route('ventes.create')->with('success', 'Vente enregistrée avec succès ✅');
    }
     public function index()
    {
        // Charger toutes les catégories avec leurs produits
        $categories = Categorie::with('produits')->get();

        // Charger les sous-entités pour l'assignation de la vente
        $subEntites = SubEntite::all();

        return view('venteDirect.index', compact('categories', 'subEntites'));
    }
  }