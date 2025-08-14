<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', // Nom du rôle
        'description', // Description du rôle
    ];
    //
}
