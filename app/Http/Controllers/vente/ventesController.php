<?php

namespace App\Http\Controllers\vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubEntite;
use App\Models\Categorie;
use App\Models\Vente;

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
            'subEntite_id' => 'nullable|exists:sub_entites,id', // null si vente directe
            'situation' => 'required|in:soldé,credit', // attention sans accent
            'remiseGlobale' => 'nullable|numeric|min:0',
            'netAPayer' => 'required|numeric|min:0',
            'detail' => 'required|array|min:1',
            'detail.*.produit_id' => 'required|exists:produits,id',
            'detail.*.quantite' => 'required|integer|min:1',
            'detail.*.prix' => 'required|numeric|min:0',
            'detail.*.remise' => 'nullable|numeric|min:0',
            'detail.*.net' => 'required|numeric|min:0',
        ]);

        // Création de la vente
        $vente = Vente::create([
            'subEntite_id' => $data['subEntite_id'] ?? null,
            'status' => $data['situation'],
            'remise_globale' => $data['remiseGlobale'] ?? 0,
            'net' => $data['netAPayer'],
            'etat_commande' => 'en_attente', // toujours brouillon au départ
        ]);

        // Ajout des détails
        foreach ($data['detail'] as $detail) {
            $vente->details()->create([
                'produit_id' => $detail['produit_id'],
                'quantite' => $detail['quantite'],
                'prix' => $detail['prix'],
                'remise' => $detail['remise'] ?? 0,
                'net' => $detail['net'],
            ]);
        }

        return redirect()->route('ventes.create')->with('success', 'Vente enregistrée avec succès ✅');
    }

    public function index()
    {
        $categories = Categorie::with('produits')->get();
        $subEntites = SubEntite::all();

        return view('venteDirect.index', compact('categories', 'subEntites'));
    }

    // Nouvelle méthode pour valider une commande
    public function valider($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->update(['etat_commande' => 'validee']);

        return back()->with('success', 'Commande validée avec succès ✅');
    }

    // Annuler une commande
    public function annuler($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->update(['etat_commande' => 'annulee']);

        return back()->with('error', 'Commande annulée ❌');
    }

public function subEntites($entiteId)
{
    $subEntites = SubEntite::where('entite_id', $entiteId)
        ->withCount(['ventes as ventes_non_payees_count' => function($q) {
            $q->where('statut', 'non payé');
        }])
        ->get();

    // On passe maintenant $entiteId à la vue
    return view('venteDirect.subentites', compact('subEntites', 'entiteId'));
}


public function nonPayes($subEntiteId)
{
    $ventes = Vente::where('sub_entite_id', $subEntiteId)
        ->where('statut', 'non payé')
        ->get();

    return view('venteDirect.nonpayes', compact('ventes', 'subEntiteId'));
}

public function historique($subEntiteId)
{
    $ventes = Vente::where('sub_entite_id', $subEntiteId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('venteDirect.historique', compact('ventes', 'subEntiteId'));
}

public function transferForm($subEntiteId)
{
    $ventes = Vente::where('sub_entite_id', $subEntiteId)
        ->where('statut', 'non payé')
        ->get();

    $autresSubEntites = SubEntite::where('id', '!=', $subEntiteId)->get();

    return view('venteDirect.transfer', compact('ventes', 'autresSubEntites', 'subEntiteId'));
}

public function transfer(Request $request, $venteId)
{
    $vente = Vente::findOrFail($venteId);
    $vente->sub_entite_id = $request->nouvelle_sub_entite_id;
    $vente->save();

    return back()->with('success', 'Vente transférée avec succès');
}

}
