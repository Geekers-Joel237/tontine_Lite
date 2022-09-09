<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
    protected $fillable = [
        'fileName',
        'filePath',
        'extension',
        'type',
        'user_id',
        'tontine_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function tontines(){
        return $this->hasMany(Tontine::class);
    }
}
