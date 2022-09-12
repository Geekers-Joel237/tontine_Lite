<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $fillable = [
        'validation',
        'user_id',
        'exercice_id',
        'tontine_id'
    ];

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
