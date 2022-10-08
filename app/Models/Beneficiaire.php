<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateSeance',
        'classement',
        'montant',
        'validation',
        'isSeanceBenef',
        'membre_id',
        'seance_id',
        'exercice_id'
    ];
}
