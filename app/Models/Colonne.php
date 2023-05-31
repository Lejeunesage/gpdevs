<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonne extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre'
    ];

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }
}