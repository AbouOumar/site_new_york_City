<?php
namespace App\Http\Controllers\reservation;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\SubEntite;
use App\Models\Entite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationsController extends Controller
{
    // Liste pour l'admin
    public function index()
    {
        $reservations = Reservation::with(['entite', 'subEntite'])->latest()->get();
        return view('reservation.index', compact('reservations'));
    }

    // Formulaire création (optionnel si admin crée lui-même)
    public function create()
    {
        $entites = Entite::all();
        $subEntites = SubEntite::all();
        return view('reservations.create', compact('entites', 'subEntites'));
    }

    // Enregistrement
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone_client' => 'required|string|max:20',
            'email_client' => 'nullable|email',
            'entite_id' => 'required|exists:entites,id',
            'sub_entite_id' => 'nullable|exists:sub_entites,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'prix' => 'nullable|numeric',
        ]);

        // Récupération des 2 lettres
        $prefix = '';
        if ($request->sub_entite_id) {
            $sub = SubEntite::find($request->sub_entite_id);
            $prefix = strtoupper(Str::limit($sub ? $sub->nom : '', 2, ''));
        } else {
            $entite = Entite::find($request->entite_id);
            $prefix = strtoupper(Str::limit($entite ? $entite->nom : '', 2, ''));
        }

        // Génération du numéro : date + heure + préfixe
        $numero = now()->format('YmdHi') . $prefix;
        $dateDebut = str_replace('T', ' ', $request->date_debut) . ':00';
        $dateFin = str_replace('T', ' ', $request->date_fin) . ':00';
        $subEntite = SubEntite::find($request->sub_entite_id);
        $prix = $subEntite ? $subEntite->prix : 0;

        Reservation::create([
            'nom_client' => $request->nom_client,
            'telephone_client' => $request->telephone_client,
            'email_client' => $request->email_client,
            'entite_id' => $request->entite_id,
            'sub_entite_id' => $request->sub_entite_id,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'prix' => $prix,
            'numero_reservation' => $numero,
            'statut' => 'en_attente'
        ]);

        return redirect()->back()->with('success', 'Réservation enregistrée avec succès.');
    }

    // Mise à jour statut
    public function updateStatus($id, $status)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['statut' => $status]);
        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }

    // Modification complète
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $entites = Entite::all();
        $subEntites = SubEntite::all();
        return view('admin.reservations.edit', compact('reservation', 'entites', 'subEntites'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone_client' => 'required|string|max:20',
            'email_client' => 'nullable|email',
            'entite_id' => 'required|exists:entites,id',
            'sub_entite_id' => 'nullable|exists:sub_entites,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'prix' => 'required|numeric',
            'statut' => 'required|in:en_attente,confirmé,annulé'
        ]);

        $reservation->update([
            'nom_client' => $request->nom_client,
            'telephone_client' => $request->telephone_client,
            'email_client' => $request->email_client,
            'entite_id' => $request->entite_id,
            'sub_entite_id' => $request->sub_entite_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'prix' => $request->prix,
            'statut' => $request->statut
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour.');
    }

    // Suppression
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }
}
