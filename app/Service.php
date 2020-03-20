<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * Guarded properties.
     *
     * @var mixed
     */
    protected $guarded = [];

    /**
     * Le service appartient à un établissement
     */
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    /**
     * Un service a plusieurs utilisateurs
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
