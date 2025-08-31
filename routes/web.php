<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hotel\HotelsController;
use App\Http\Controllers\produit\CategoriesController;
use App\Http\Controllers\produit\ProduitsController;
use App\Http\Controllers\entite\EntitesController;
use App\Http\Controllers\entite\SubEntitesController;
use App\Http\Controllers\reservation\ReservationsController;
use App\Http\Controllers\utilisateur\UtilisateursController;
use App\Http\Controllers\vente\VentesController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
*/

// Page d’accueil
Route::get('/', [HotelsController::class, 'accueil'])->name('accueil');

// Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', fn() => view('dashboard'));
Route::get('/dashboard/superadmin', [SuperAdminDashboardController::class, 'index'])->name('dashboard.superadmin');

// Hotels
Route::get('/hotels/vitrine', [HotelsController::class, 'listeVitrine'])->name('hotels.vitrine');
Route::get('/hotels/{id}', [HotelsController::class, 'detail'])->name('hotels.detail');
Route::resource('hotels', HotelsController::class)->names([
    'index'   => 'hotels.index',
    'create'  => 'hotels.create',
    'store'   => 'hotels.store',
    'show'    => 'hotels.show',
    'edit'    => 'hotels.edit',
    'update'  => 'hotels.update',
    'destroy' => 'hotels.destroy',
]);

// Entités
Route::resource('entites', EntitesController::class)->names([
    'index'   => 'entites.index',
    'create'  => 'entites.create',
    'store'   => 'entites.store',
    'show'    => 'entite.detail',
    'edit'    => 'entites.edit',
    'update'  => 'entites.update',
    'destroy' => 'entites.destroy',
]);
Route::get('hotels/{hotel}/entites', [EntitesController::class, 'getEntitesByHotel']);

// Sub-Entités
Route::resource('subentites', SubEntitesController::class)->names([
    'index'   => 'subentites.index',
    'create'  => 'subentites.create',
    'store'   => 'subentites.store',
    'show'    => 'subentites.show',
    'edit'    => 'subentites.edit',
    'update'  => 'subentites.update',
    'destroy' => 'subentites.delete',
]);

// Catégories
Route::resource('categories', CategoriesController::class)->names([
    'index'   => 'categories.index',
    'store'   => 'categories.store',
    'update'  => 'categories.update',
    'delete'  => 'categories.delete',
]);

// Produits
Route::get('produits', [ProduitsController::class, 'index'])->name('produits.index');
Route::post('produits/store', [ProduitsController::class, 'store'])->name('produits.store');
Route::post('produits/{produit}', [ProduitsController::class, 'update'])->name('produits.update');
Route::delete('produits/{produit}', [ProduitsController::class, 'delete'])->name('produits.delete');

// Réservations
Route::resource('reservations', ReservationsController::class)->except(['show'])->names([
    'index'   => 'reservations.index',
    'create'  => 'reservations.create',
    'store'   => 'reservations.store',
    'edit'    => 'reservations.edit',
    'update'  => 'reservations.update',
    'destroy' => 'reservations.destroy',
]);
Route::patch('reservations/{id}/status/{status}', [ReservationsController::class, 'updateStatus'])->name('reservations.updateStatus');

// Utilisateurs
Route::resource('utilisateurs', UtilisateursController::class)->names([
    'index'   => 'utilisateurs.index',
    'create'  => 'utilisateurs.create',
    'store'   => 'utilisateurs.store',
    'show'    => 'utilisateur.show',
    'edit'    => 'utilisateurs.edit',
    'update'  => 'utilisateurs.update',
    'destroy' => 'utilisateurs.destroy',
]);

// Ventes
Route::get('ventes/entite/{id}', [VentesController::class, 'subEntites'])->name('ventes.subEntites');
Route::get('ventes/subentite/{id}/historique', [VentesController::class, 'historique'])->name('ventes.historique');
Route::get('ventes/subentite/{id}/nonpayes', [VentesController::class, 'nonPayes'])->name('ventes.nonPayes');
Route::get('ventes/subentite/{id}/transfer', [VentesController::class, 'transferForm'])->name('ventes.transfer');
Route::post('ventes/transfer/{venteId}', [VentesController::class, 'transfer'])->name('ventes.transfer.do');
Route::resource('ventes', VentesController::class)->names([
    'index'   => 'ventes.index',
    'create'  => 'ventes.create',
    'store'   => 'ventes.store',
    'show'    => 'ventes.show',
    'edit'    => 'ventes.edit',
    'update'  => 'ventes.update',
    'destroy' => 'ventes.destroy',
]);
