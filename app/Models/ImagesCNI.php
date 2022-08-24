<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesCNI extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomImage',
        'user_id'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
