<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomC',
        'solde',
        'tontine_id'
    ];

    public function tontines() {
        return $this->hasMany(Tontine::class);
    }
}
