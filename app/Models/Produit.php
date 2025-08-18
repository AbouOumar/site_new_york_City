<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
     protected $fillable = ['categorie_id','nom','prix'];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
        
    }
    //
}
