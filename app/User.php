<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns the user initials.
     */
    public function initials()
    {
        $words = explode(' ', $this->name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }

        return strtoupper($initials);
    }

    /**
     * Un utilisateur a plusieurs établissements
     */
    public function etablissement()
    {
        return $this->hasMany(Etablissement::class);
    }

    /**
     * Un utilisateur peut appartenir a plusieurs services.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
