<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubEntite;
use App\Models\Categorie;
use App\Models\Vente;
use Illuminate\Support\Facades\Log;

class VentesController extends Controller
{
    /**
     * Affiche le formulaire de création de vente
     */
    public function create()
    {
        $subEntites = SubEntite::all();
        $categories = Categorie::with('produits')->get(); // Produits par catégorie

        return view('venteDirect.index', compact('subEntites', 'categories'));
    }

   
    /**
     * Enregistre une nouvelle vente dans le système.
     * 
     * Étapes :
     * 1. Valide les données reçues (sécurité).
     * 2. Crée une entrée principale dans la table `ventes`.
     * 3. Ajoute les lignes de détail (produits vendus).
     * 4. Retourne une réponse JSON pour confirmer l'enregistrement.
     */
    public function store(Request $request)
{
    Log::info('Données reçues:', $request->all());

    // Validation adaptée
    $data = $request->validate([
        'sub_entite_id'   => 'nullable|exists:sub_entites,id',
        'status'          => 'required|in:soldé,crédit',
        'remise_globale'  => 'nullable|numeric|min:0',
        'net'             => 'required|numeric|min:0',
        'etat_commande'   => 'nullable|in:en_attente,validee,annulee', // Ajouté
        'details'         => 'required|array|min:1',
        'details.*.produit_id' => 'required|exists:produits,id',
        'details.*.quantite'   => 'required|integer|min:1',
        'details.*.prix'       => 'required|numeric|min:0',
        'details.*.remise'     => 'nullable|numeric|min:0',
        'details.*.net'        => 'required|numeric|min:0',
    ]);

    // Calcul de la quantité totale à partir des détails
    $quantiteTotale = collect($data['details'])->sum('quantite');
    $total = collect($data['details'])->sum(function($item) {
        return $item['prix'] * $item['quantite'];
    });

    // Création de la vente principale
    $vente = Vente::create([
        'sub_entite_id'   => $data['sub_entite_id'] ?? null,
        'status'          => $data['status'],
        'remise_globale'  => $data['remise_globale'] ?? 0,
        'net'             => $data['net'],
        'total'           => $total,
        'quantite'        => $quantiteTotale, // Calculé à partir des détails
        'etat_commande'   => $data['etat_commande'] ?? 'en_attente',
    ]);

    // Enregistrement des lignes de détail
    foreach ($data['details'] as $detail) {
        $vente->details()->create([
            'produit_id' => $detail['produit_id'],
            'quantite'   => $detail['quantite'],
            'prix'       => $detail['prix'],
            'remise'     => $detail['remise'] ?? 0,
            'net'        => $detail['net'],
        ]);
    }

    return response()->json(['message' => 'Vente enregistrée avec succès ✅']);
}


    /**
     * Liste des ventes disponibles
     */
    public function index() 
    {
        $categories = Categorie::with('produits')->get();
        $subEntites = SubEntite::all();

        return view('venteDirect.index', compact('categories', 'subEntites'));
    }

    /**
     * Valider une commande
     */
    public function valider($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->update(['etat_commande' => 'validee']);

        return back()->with('success', 'Commande validée avec succès ✅');
    }

    /**
     * Annuler une commande
     */
    public function annuler($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->update(['etat_commande' => 'annulee']);

        return back()->with('error', 'Commande annulée ❌');
    }

    /**
     * Liste des sous-entités avec ventes non payées
     */
    public function subEntites($entiteId)
    {
        $subEntites = SubEntite::where('entite_id', $entiteId)
            ->withCount(['ventes as ventes_non_payees_count' => function($q) {
                $q->where('status', 'credit'); // ⚡ harmonisé
            }])
            ->get();

        return view('venteDirect.subentites', compact('subEntites', 'entiteId'));
    }

    /**
     * Ventes non payées pour une sous-entité
     */
    public function nonPayes($subEntiteId)
    {
        $ventes = Vente::where('sub_entite_id', $subEntiteId)
            ->where('status', 'credit')
            ->get();

        return view('venteDirect.nonpayes', compact('ventes', 'subEntiteId'));
    }

    /**
     * Historique des ventes
     */
    public function historique($subEntiteId)
    {
        $ventes = Vente::where('sub_entite_id', $subEntiteId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('venteDirect.historique', compact('ventes', 'subEntiteId'));
    }

    /**
     * Formulaire de transfert de ventes
     */
    public function transferForm($subEntiteId)
    {
        $ventes = Vente::where('sub_entite_id', $subEntiteId)
            ->where('status', 'credit')
            ->get();

        $autresSubEntites = SubEntite::where('id', '!=', $subEntiteId)->get();

        return view('venteDirect.transfer', compact('ventes', 'autresSubEntites', 'subEntiteId'));
    }

    /**
     * Transfert d’une vente vers une autre sous-entité
     */
    public function transfer(Request $request, $venteId)
    {
        $request->validate([
            'nouvelle_sub_entite_id' => 'required|exists:sub_entites,id'
        ]);

        $vente = Vente::findOrFail($venteId);
        $vente->sub_entite_id = $request->nouvelle_sub_entite_id;
        $vente->save();

        return back()->with('success', 'Vente transférée avec succès ✅');
    }
}
