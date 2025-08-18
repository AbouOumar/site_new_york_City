<?php   
namespace App\Http\Controllers\hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelsController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // validation de l'image
        ]);

        $data = $request->only(['nom', 'description', 'location']);

        if ($hotel->image && file_exists(storage_path('app/public/' . $hotel->image))) {
    unlink(storage_path('app/public/' . $hotel->image));
}


        Hotel::create($data);

        return redirect()->route('hotels.index')->with('success', 'Hôtel ajouté avec succès.');
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nom', 'description', 'location']);

        if ($request->hasFile('image')) {
            // supprimer l'ancienne image si elle existe
          if ($hotel->image && file_exists(storage_path('app/public/' . $hotel->image))) {
    unlink(storage_path('app/public/' . $hotel->image));
}


            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($data);

        return redirect()->route('hotels.index')->with('success', 'Hôtel modifié avec succès.');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->image && file_exists(storage_path('app/public/' . $hotel->image))) {
    unlink(storage_path('app/public/' . $hotel->image));
}


        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hôtel supprimé avec succès.');
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
    public function detail($id) {
         $hotel = Hotel::with('entites.subEntites')->findOrFail($id);
          return view('hotel_detail', compact('hotel'));
         }
}
