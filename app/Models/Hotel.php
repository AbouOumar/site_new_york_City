<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'location',
        'image',
        
    ];
     public function entites()
    {
        return $this->hasMany(Entite::class);
    }
    //
}
