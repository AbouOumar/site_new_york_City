<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Reservation;
use App\Models\Entite;
use App\Models\SubEntite;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client',
        'telephone_client',
        'email_client',
        'numero_reservation',
        'entite_id',
        'sub_entite_id',
        'date_debut',
        'date_fin',
        'prix',
        'statut',
    ]; 

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }

    public function subEntite()
    {
        return $this->belongsTo(SubEntite::class, 'sub_entite_id');
    }
}
