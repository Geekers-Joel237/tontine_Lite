<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomFichier',
        'filePath',
        'extension',
        'user_id',
        'evenement_id',
        'rapport_id',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
