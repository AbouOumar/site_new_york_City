<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    protected $table = 'entites';

    protected $fillable = [
        'nom',
        'description',
        'hotel_id',
        'type',
    ];

    // Relation avec Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    // Relation avec Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function subEntites()
    {
        return $this->hasMany(SubEntite::class);
    }
}
