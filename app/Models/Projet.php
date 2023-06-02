<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
    ];


    /**
     * defines the relationship with membre_equipe
     */

     public function membre_equipe()
     {
        return $this->hasMany(MembreEquipe::class);
     }

}
