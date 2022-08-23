<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'dateEvenement',
        'image',
        'texte'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function reunion(){
        return $this->belongsToMany(Reunion::class);
    }

}
