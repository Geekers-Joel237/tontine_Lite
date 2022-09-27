<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'nomE',
        'frequence',
        'dateDebutE',
        'duree',
        'periodicite',
        'heureTontine',
        'lieuTontine',
        'statusE',
        'etatE',
        'tontine_id'
    ];

    public function tontines(){
        return $this->hasMany(Tontine::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function tontine(){
        return $this->belongsToMany(Tontine::class);
    }
}
