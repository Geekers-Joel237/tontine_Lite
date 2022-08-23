<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateSeance',
        'heureSeance',
        'etat'

    ];

    public function reunions() {
        return $this->hasMany(Reunion::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function tontine(){
        return $this->belongsToMany(Tontine::class);
    }
}
