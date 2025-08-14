<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;  // Modèle utilisateur (à créer)
use App\Models\Role;  // Modèle rôle (si nécessaire)
use App\Models\Hotel;

class UtilisateursController extends Controller
{
    public function index()
    {
        //$utilisateurs = Utilisateur::all();  // récupère tous les utilisateurs
        $utilisateurs = Utilisateur::with(['hotel', 'role'])->get(); // Récupère les utilisateurs avec leurs hôtels et rôles
        $roles = Role::all();  // récupère tous les rôles (si nécessaire)
        $hotels = Hotel::all();  // récupère tous les hôtels (si nécessaire)
        return view('utilisateurs.index', compact('utilisateurs', 'roles', 'hotels'));  // passe à la vue (corrigé noms)
    }

    public function create()
    {
        return view('utilisateur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|string', //|min:6|confirmed',  // confirmation via champ password_confirmation
            'role_id' => 'required|exists:roles,id',
            'hotel_id' => 'nullable|exists:hotels,id',
        ]); 

        Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'hotel_id' => $request->hotel_id,
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateur.edit', compact('utilisateur'));
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $utilisateur->id,
            'password' => 'nullable|string', //|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'hotel_id' => 'nullable|exists:hotels,id',
        ]);

        $data = [
            'nom' => $request->nom,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'hotel_id' => $request->hotel_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $utilisateur->update($data);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
