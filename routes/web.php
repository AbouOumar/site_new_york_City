<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hotel\HotelsController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\utilisateur\UtilisateursController;
use App\Http\Controllers\entite\EntitesController;
use App\Http\Controllers\entite\SubEntitesController;
use App\Http\Controllers\reservation\ReservationsController;

Route::get('/', [HotelsController::class, 'accueil'])->name('home');
//Les Routes pour les hotels
Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
Route::get('/hotels/create', [HotelsController::class, 'create'])->name('hotels.create');
Route::post('/hotels', [HotelsController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{id}', [HotelsController::class, 'show'])->name('hotels.show');
Route::get('/hotels/{id}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{id}', [HotelsController::class, 'update'])->name('hotels.update');
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
Route::get('/entites/{entite}', [EntitesController::class, 'show'])->name('entite.detail');


// SubEntites (associées à une entité)
Route::resource('subentites', SubEntitesController::class);
Route::get('/subentites', [SubEntitesController::class, 'index'])->name('subentites.index');
Route::delete('/subentites/{id}', [EntitesController::class, 'deleteSubEntite'])->name('subentites.delete');


    
    // Liste des réservations
    Route::get('/reservations', [ReservationsController::class, 'index'])->name('reservations.index');
    
    // Formulaire création (si besoin)
    Route::get('/reservations/create', [ReservationsController::class, 'create'])->name('reservations.create');
    
    // Enregistrer une réservation
    Route::post('/reservations', [ReservationsController::class, 'store'])->name('reservations.store');

    // Éditer
    Route::get('/reservations/{id}/edit', [ReservationsController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}', [ReservationsController::class, 'update'])->name('reservations.update');

    // Supprimer
    Route::delete('/reservations/{id}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');

    // Mettre à jour le statut (confirmé / annulé / en attente)
    Route::patch('/reservations/{id}/status/{status}', [ReservationsController::class, 'updateStatus'])
        ->name('reservations.updateStatus');


Route::get('/test', function() {
    return view('test');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/hotels/vitrine', [HotelsController::class, 'listeVitrine'])->name('hotels.vitrine');
