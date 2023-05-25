<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembreEquipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipe_id',
        'user_id',
        'role'
    ];
}
