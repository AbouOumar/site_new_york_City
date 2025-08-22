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
        'sub_entite_id'

    ];
    protected $hidden = ['password'];
    public function role()
{
    return $this->belongsTo(Role::class);
}

public function hotel()
{
    return $this->belongsTo(Hotel::class);
}

public function subEntite()
{
    return $this->belongsTo(SubEntite::class);
}

    //
}
