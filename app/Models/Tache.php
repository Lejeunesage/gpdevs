<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'equipe_id',
        'user_id',
        'date_heure_livraison',
        'colonne_id',
        'priorite',
    ];


    public function colonne()
    {
        return $this->belongsTo(Colonne::class, 'colonne_id');
    }
}
