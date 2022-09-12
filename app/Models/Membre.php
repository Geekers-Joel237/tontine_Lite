<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateIntegration',
        'statutMembre',
        'estActif',
        'user_id',
        'exercice_id',
        'tontine_id',
        'demande_id'
    ];

    public function seance(){
        return $this->belongsToMany(Seance::class);
    }



}
