<?php
namespace App\Http\Controllers\reservation;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\SubService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationsController extends Controller
{
    // Liste pour l'admin
    public function index()
    {
        $reservations = Reservation::with(['service', 'subService'])->latest()->get();
        return view('reservation.index', compact('reservations'));
        
    }

    // Formulaire création (optionnel si admin crée lui-même)
    public function create()
    {
        $services = Service::all();
        return view('reservations.create', compact('services'));
    }

    // Enregistrement
    public function store(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone_client' => 'required|string|max:20',
            'email_client' => 'nullable|email',
            'service_id' => 'required|exists:services,id',
            'sub_service_id' => 'nullable|exists:sub_services,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'prix' => 'required|numeric',
        ]);

        // Récupération des 2 lettres
        $prefix = '';
        if ($request->sub_service_id) {
            $sub = SubService::find($request->sub_service_id);
            $prefix = strtoupper(Str::limit($sub->nom, 2, ''));
        } else {
            $service = Service::find($request->service_id);
            $prefix = strtoupper(Str::limit($service->nom, 2, ''));
        }

        // Génération du numéro : date + heure + préfixe
        $numero = now()->format('YmdHi') . $prefix;

        Reservation::create(array_merge(
            $request->all(),
            ['numero_reservation' => $numero]
        ));

        return redirect()->route('reservations.index')->with('success', 'Réservation enregistrée avec succès.');
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
        $services = Service::all();
        return view('admin.reservations.edit', compact('reservation', 'services'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone_client' => 'required|string|max:20',
            'email_client' => 'nullable|email',
            'service_id' => 'required|exists:services,id',
            'sub_service_id' => 'nullable|exists:sub_services,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'prix' => 'required|numeric',
            'statut' => 'required|in:en_attente,confirmé,annulé'
        ]);

        $reservation->update($request->all());

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
