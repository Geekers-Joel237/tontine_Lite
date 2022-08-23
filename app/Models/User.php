<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'telephone',
        'addresse',
        'ville',
        'pays',
        'numCni'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reunion(){
        return $this->belongsToMany(Reunion::class);
    }

    public function evenement(){
        return $this->belongsToMany(Evenement::class);
    }

    public function annonce(){
        return $this->belongsToMany(Annonce::class);
    }

    public function seance(){
        return $this->belongsToMany(Seance::class);
    }

    public function tontine(){
        return $this->belongsToMany(Tontine::class);
    }
}
