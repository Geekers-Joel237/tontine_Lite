<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'nomS',
        'dateS',
        'statutS',
        'etatS',
        // 'frequence',
        'exercice_id'
    ];

    public function exercices(){
        return $this->hasMany(Exercice::class);
    }

    public function membre(){
        return $this->belongsToMany(Membre::class);
    }
}
