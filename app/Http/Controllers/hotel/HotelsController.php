<?php 

namespace App\Http\Controllers\hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelsController extends Controller
{
    //fonction pour l'affichage de la liste des hôtels
    public function index()
    {
        $hotels = Hotel::all();  // récupère tous les hôtels
        return view('hotels.index', compact('hotels'));  // passe les hôtels à la vue
    } 

    // fonction pour l'ajout d'un hôtel
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        Hotel::create($request->only(['nom', 'description', 'location']));

        return redirect()->route('hotels.index')->with('success', 'Hôtel ajouté avec succès.');
    }

    
    // fonction pour la modification d'un hôtel
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $hotel->update($request->only(['nom', 'description', 'location']));

        return redirect()->route('hotels.index')->with('success', 'Hôtel modifié avec succès.');
    }

    // fonction pour la suppression d'un hôtel
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hôtel supprimé avec succès.');
    }

    public function listeVitrine()
{
    $hotels = Hotel::all();
    return view('hotels.vitrine', compact('hotels'));
}

public function show($id)
{
    $hotel = Hotel::findOrFail($id);
    return view('hotels.show', compact('hotel'));
}
public function accueil()
    {
        $hotels = Hotel::all();
        return view('welcome', compact('hotels'));
    }

    // Page détail d'un hôtel
    public function detail($id)
    {
        $hotel = Hotel::with('entites.subEntites')->findOrFail($id);
        return view('hotel_detail', compact('hotel'));
    }
}
