<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubEntite extends Model
{
    protected $fillable = [
        'entite_id',
         'nom', 
         'prix',
        'image',
         'forfait',
         'description',
         'nombre_place',
         'emplacement'
        ];

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }
    //
}
