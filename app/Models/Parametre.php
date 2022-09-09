<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomP',
        'montant',
        'tontine_id'
    ];
    
    public function tontines() {
        return $this->hasMany(Tontine::class);
    }
}
