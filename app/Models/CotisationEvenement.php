<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotisationEvenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'motif',
        'etat',
        'user_id',
        'evenement_id',
        'reunion_id'
    ];
}
