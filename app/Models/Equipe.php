<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'creer_par',
    ];


    /**
     * defines the relationship with membre_equipe
     */

     public function membre_equipe()
     {
        return $this->hasMany(MembreEquipe::class);
     }

}
