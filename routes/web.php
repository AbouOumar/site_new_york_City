<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hotel\HotelsController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\utilisateur\UtilisateursController;
use App\Http\Controllers\entite\EntitesController;
use App\Http\Controllers\entite\SubEntitesController;
use App\Http\Controllers\reservation\ReservationsController;
use App\Http\Controllers\vente\VentesController;
use App\Models\SubEntite;
use App\Http\Controllers\produit\ProduitsController;
use App\Http\Controllers\produit\CategoriesController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard après connexion
Route::get('/dashboard', function() {
    return view('hotels'); // créer une vue dashboard.blade.php plus tard
})->middleware('auth');

Route::get('/', [HotelsController::class, 'accueil'])->name('home');
//Les Routes pour les hotels
Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
Route::get('/hotels/create', [HotelsController::class, 'create'])->name('hotels.create');
Route::post('/hotels', [HotelsController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{id}', [HotelsController::class, 'show'])->name('hotels.show');
Route::get('/hotels/{id}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{hotel}', [HotelsController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{id}', [HotelsController::class, 'destroy'])->name('hotels.destroy');
Route::resource('hotels', HotelsController::class);
// Détail d'un hôtel
Route::get('/hotel/{id}', [HotelsController::class, 'detail'])->name('hotels.detail');
Route::get('/hotels/{hotel}/entites', [EntitesController::class, 'getEntitesByHotel']);



// Dashboard pour le Super Admin
Route::get('/dashboard/superadmin', [SuperAdminDashboardController::class, 'index'])
    ->name('dashboard.superadmin');
  //  ->middleware('auth');  // protège par authentification

// Gestion des utilisateurs CRUD
Route::resource('utilisateurs', UtilisateursController::class);  //  ->middleware('auth');
Route::get('/utilisateurs', [UtilisateursController::class, 'index'])->name('utilisateurs.index');
Route::get('/utilisateurs/create', [UtilisateursController::class, 'create'])->name('utilisateur.create');
Route::post('/utilisateurs', [UtilisateursController::class, 'store'])->name('utilisateur.store');
Route::get('/utilisateurs/{id}', [UtilisateursController::class, 'show'])->name('utilisateur.show');
Route::get('/utilisateurs/{id}/edit', [UtilisateursController::class, 'edit'])->name('utilisateur.edit');
Route::put('/utilisateurs/{id}', [UtilisateursController::class, 'update'])->name('utilisateur.update');
Route::delete('/utilisateurs/{id}', [UtilisateursController::class, 'destroy'])->name('utilisateur.destroy');

// Utilisateurs
Route::resource('utilisateurs', UtilisateursController::class);

// Entites
Route::get('/entites', [EntitesController::class, 'index'])->name('entite.index');
Route::resource('entites', EntitesController::class);
Route::put('/entites/{entite}', [EntitesController::class, 'update'])->name('entite.update');
Route::get('/entites/{entite}', [EntitesController::class, 'show'])->name('entite.detail');


// SubEntites (associées à une entité)
Route::resource('subentites', SubEntitesController::class);
Route::get('/subentites', [SubEntitesController::class, 'index'])->name('subentites.index');
Route::put('/subentites/{subentite}', [SubEntitesController::class, 'update'])->name('subentites.update');
Route::delete('/subentites/{id}', [SubEntitesController::class, 'destroy'])->name('subentites.delete');


    
    // Liste des réservations
    Route::get('/reservations', [ReservationsController::class, 'index'])->name('reservations.index');
    
    // Formulaire création (si besoin)
    Route::get('/reservations/create', [ReservationsController::class, 'create'])->name('reservations.create');
    
    // Enregistrer une réservation
    Route::post('/reservations', [ReservationsController::class, 'store'])->name('reservations.store');

    // Éditer
    Route::get('/reservations/{id}/edit', [ReservationsController::class, 'edit'])->name('reservations.edit');
    Route::patch('/reservations/{id}', [ReservationsController::class, 'update'])->name('reservations.update');

    // Supprimer
    Route::delete('/reservations/{id}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');

    // Mettre à jour le statut (confirmé / annulé / en attente)
    Route::patch('/reservations/{id}/status/{status}', [ReservationsController::class, 'updateStatus'])->name('reservations.updateStatus');




Route::get('/home',[HotelsController::class, 'accueil'])->name('accueil');

Route::get('/hotels/vitrine', [HotelsController::class, 'listeVitrine'])->name('hotels.vitrine');

Route::get('/vente-direct', [\App\Http\Controllers\vente\ventesController::class, 'index'])->name('ventes.index');


Route::resource('ventes', VentesController::class);
Route::post('/ventes', [VentesController::class, 'store'])->name('ventes.store');
// Ventes / SubEntités
Route::prefix('ventes')->group(function() {
    Route::get('entite/{id}', [VentesController::class, 'subEntites'])->name('ventes.subEntites');
    Route::get('subentite/{id}/nonpayes', [VentesController::class, 'nonPayes'])->name('ventes.nonPayes');
    Route::get('subentite/{id}/historique', [VentesController::class, 'historique'])->name('ventes.historique');
    Route::get('subentite/{id}/transfer', [VentesController::class, 'transferForm'])->name('ventes.transfer');
    Route::post('transfer/{venteId}', [VentesController::class, 'transfer'])->name('ventes.transfer.do');
});



Route::prefix('produits')->name('produits.')->group(function() {
    Route::get('/', [ProduitsController::class, 'index'])->name('index');
    Route::post('/store', [ProduitsController::class, 'store'])->name('store');
    Route::post('/{produit}', [ProduitsController::class, 'update']); // mise à jour via POST + _method=PUT
    Route::delete('/{produit}', [ProduitsController::class, 'delete'])->name('delete'); // suppression
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoriesController::class, 'store'])->name('categories.store');
    Route::put('/{categorie}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/{categorie}', [CategoriesController::class, 'delete'])->name('categories.delete');
});
