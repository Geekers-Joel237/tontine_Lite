<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retard extends Model
{
    use HasFactory;
    protected $fillable = [
        'statut',
        'seance_id',
        'exercice_id',
        'membre_id',
        'tontine_id'
    ];

    public function seances() {
        return $this->hasMany(Seance::class);
    }
    public function exercices() {
        return $this->hasMany(Exercice::class);
    }
    public function membres() {
        return $this->hasMany(Membre::class);
    }
}
