<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role_id',
        'hotel_id',

    ];
    public function role()
{
    return $this->belongsTo(Role::class);
}

public function hotel()
{
    return $this->belongsTo(Hotel::class);
}

    //
}
