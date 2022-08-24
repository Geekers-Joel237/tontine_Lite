<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomCotisation',
        'motif',
        'etat',
        'montant',
        'classement',
        'user_id',
        'seance_id',
        'tontine_id'
    ];
}
