<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['entite_id','total','remise_globale','net_a_payer','situation'];

    public function detail() {
        return $this->hasMany(DetailVente::class);
    }

    public function subEntite() {
        return $this->belongsTo(SubEntite::class);
    }
    //
}
