<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomT',
        'montantT',
        'slogan',
        'reglement',
        'maxT',
        'retard',
        'sanction',
        'echec',
        'type',
        'codeAdhesion',
        'validation',
        'user_id',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function exercice(){
        return $this->belongsToMany(Exercice::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
