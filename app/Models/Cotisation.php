<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'motif',
        'etat',
        'montant',
        'modePaiement',
        'seance_id',
        'membre_id',
        'retard_id',
        'echec_id',
        'caisse_id',
        'tontine_id',
        'exercice_id'
    ];
    public function seances() {
        return $this->hasMany(Seance::class);
    }
    public function membres() {
        return $this->hasMany(Membre::class);
    }
    public function retards() {
        return $this->hasMany(Retard::class);
    }
    public function echecs() {
        return $this->hasMany(Echec::class);
    }
    public function caisses() {
        return $this->hasMany(Caisse::class);
    }

}
