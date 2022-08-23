<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomReunion',
        'codeAdhesion',
        'reglement',
        'slogan',
        'mmaxEffectif'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);

    }

    public function evenement(){
        return $this->belongsToMany(Evenement::class);

    }
}
