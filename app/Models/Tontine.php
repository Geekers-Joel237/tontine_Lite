<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    use HasFactory;
    protected $fillable  = [
        'intitule',
        'monnaie',
        'modePaiement',
        'reglement',
        'numeroCompte',
        'effectifMax',
        'montant',
        'reunion_id'
    ];

    public function reunions(){
        return $this->hasMany(Reunion::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function seance(){
        return $this->belongsToMany(Seance::class);
    }
}
