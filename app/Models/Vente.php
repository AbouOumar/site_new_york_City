<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'subEntite_id',    // nullable si vente directe
        'remise_globale',
        'net',             // ton netAPayer
        'status',          // soldé | credit
        'etat_commande'    // en_attente | validee | annulee
    ];

    // Relation avec les détails
    public function details() {
        return $this->hasMany(DetailVente::class);
    }

    // Relation avec la sous-entité (point de vente/table)
    public function subEntite() {
        return $this->belongsTo(SubEntite::class,'sub_entite_id');
    }
    
}
