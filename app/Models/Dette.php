<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dette extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'modePaiement',
        'status',
        'tontine_id',
        'exercice_id',
        'membre_id',
        'retard_id',
        'echec_id',
        'caisse_id',
        'cotisation_id'
    ];
    public function cotisations() {
        return $this->hasMany(Cotisation::class);
    }
    public function caisses() {
        return $this->hasMany(Caisse::class);
    }
    public function echecs() {
        return $this->hasMany(Echec::class);
    }
    public function retards() {
        return $this->hasMany(Retard::class);
    }
    public function membres() {
        return $this->hasMany(Membre::class);
    }
    public function exercices() {
        return $this->hasMany(Exercice::class);
    }
    public function tontines() {
        return $this->hasMany(Tontine::class);
    }
}
