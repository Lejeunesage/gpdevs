<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembreProjet extends Model
{
    use HasFactory;

    protected $fillable = [
        'projet_id',
        'user_id',
        'role'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }
}
